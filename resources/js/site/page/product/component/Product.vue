<template>
  <div>
    <div class="row">
      <div class="col-md-5">
        <!-- <slot name="image"></slot> -->
        <!-- <img :src="product.avatar" class="w-100" alt="" /> -->
        <div class="cs-carousel">
          <div class="cs-carousel-images">
            <div>
              <label
                v-for="(image, key) in product.images"
                :class="{ active: key == navigateTo }"
                :key="key"
                :style="{ backgroundImage: `url('${image.avatar}')` }"
                class="image-item"
                name="navigateTo"
              >
                <input hidden type="radio" v-model="navigateTo" :value="key" />
              </label>
            </div>
          </div>
          <carousel
            class="cs-carousel-main"
            @page-change="pageChange"
            :navigateTo="navigateTo"
            :paginationEnabled="false"
            :perPage="1"
            :loop="true"
            :navigationEnabled="false"
          >
            <slide v-for="image in product.images" :key="image.id">
              <div
                class="slide-image"
                :style="{ backgroundImage: `url('${image.avatar}')` }"
              ></div>
            </slide>
          </carousel>
        </div>
      </div>

      <div class="col-md-6">
        <slot name="about"></slot>
        <template v-for="product_property_type in product.product_property_types">
          <div class="form-group" :key="product_property_type.id">
            <label class="d-block">{{ product_property_type.name }}</label>
            <!-- RADIO -->
            <template v-if="product_property_type.type == 'color_property'">
              <label
                v-for="(
                  product_property_detail, key
                ) in product_property_type.product_property_details"
                :key="key"
                :title="product_property_detail.name"
                class="prop-radio"
              >
                <input
                  v-model="property[product_property_type.id]"
                  :name="product_property_detail.id + 'd'"
                  :value="product_property_detail.id"
                  class="radio"
                  type="radio"
                  hidden
                />
                <div
                  class="radio-color mr-1"
                  :style="{ background: product_property_detail.value }"
                ></div>
              </label>
            </template>

            <!-- SELECT -->
            <template
              v-else-if="
                product_property_type.type_element == 'selecbox' &&
                product_property_type.type == 'text_property'
              "
            >
              <select
                v-model="property[product_property_type.id]"
                class="form-control rounded-0"
              >
                <option
                  v-for="(
                    product_property_detail, key
                  ) in product_property_type.product_property_details"
                  :key="key"
                  :value="product_property_detail.id"
                >
                  {{ product_property_detail.name }}
                </option>
              </select>
            </template>

            <!-- IMAGE -->
            <template v-else-if="product_property_type.type == 'image_property'">
              <div class="row">
                <label
                  v-for="(
                    product_property_detail, key
                  ) in product_property_type.product_property_details"
                  class="col-6 prop-image-box"
                  :key="key"
                >
                  <input
                    v-model="property[product_property_type.id]"
                    :name="product_property_detail.id + 'd'"
                    :value="product_property_detail.id"
                    class="radio"
                    type="radio"
                    hidden
                  />
                  <div
                    class="prop-image"
                    :style="{ background: `url('${product_property_detail.image}')` }"
                  >
                    {{ product_property_detail.name }}
                  </div>
                </label>
              </div>
            </template>
            <small id="emailHelp" class="form-text text-muted" hidden
              >We'll never share your email with anyone else.</small
            >
          </div>
        </template>
        <div class="d-flex">
          <InputNumber v-model="mount" />
          <button class="ml-3 btn btn-danger d-block rounded-0" @click="addToCart">
            <i class="pe-7s-cart mr-2" aria-hidden="true"></i>Thêm vào giỏ hàng
          </button>
        </div>
        <div>
          <slot name="bottom"></slot>
        </div>
      </div>
    </div>
    <Modal class="modal-body" v-if="showCart" v-model="showCart">
      <cart>
        <div slot-scope="slotProps">
          <button
            class="rounded-0 btn btn-primary font-weight-bold mr-2 text-white"
            data-dismiss="modal"
          >
            Tiếp tục mua hàng
          </button>
          <a
            v-if="slotProps.mount"
            href="/thanh-toan"
            class="rounded-0 btn btn-danger font-weight-bold text-white"
          >
            Tiến Hành thanh toán</a
          >
        </div>
      </cart>
    </Modal>
  </div>
</template>

<script>
import InputNumber from "../../../components/InputNumber";
import cart from "../../../utils/cart";
import Modal from "../../../components/Modal";

export default {
  components: {
    InputNumber,
    Modal,
  },
  data() {
    return {
      property: {},
      mount: 1,
      showCart: false,
      navigateTo: 0,
    };
  },
  props: ["product"],
  mounted() {
    console.log(this.product);
    this.initProperty();
  },
  methods: {
    initProperty() {
      this.property = this.product.product_property_types.reduce((acc, cur) => {
        acc[cur.id] = cur.product_property_details[0].id;
        return acc;
      }, {});
    },

    addToCart() {
      const key = Object.keys(this.property).reduce((acc, cur) => {
        acc = acc + `_${cur}_${this.property[cur]}`;
        return acc;
      }, `product_${this.product.id}`);

      cart.pushCart(key, this.mount);
      this.showCart = true;

      // this.$refs.cart.loadData()
    },

    pageChange(navigateTo) {
      this.navigateTo = navigateTo;
    },
  },
};
</script>

<style lang="scss" scoped>
.prop-radio {
  .radio-color {
    opacity: 0.6;
    border: 1px solid rgba(0, 0, 0, 0.1);
    width: 30px;
    height: 30px;
    transition: 0.3s;
    cursor: pointer;
  }

  .radio-color:hover {
    opacity: 0.9;
  }

  .radio:checked + .radio-color {
    opacity: 1 !important;
    border: 2px solid #000 !important;
  }
}
.prop-image-box {
  .radio:checked + .prop-image {
    border-color: #000 !important;
  }
  .prop-image {
    padding: 10px;
    height: 70px;
    width: 100%;
    cursor: pointer;
    border: 2px solid rgba(0, 0, 0, 0.05);
  }
}

.slide-image {
  padding-top: 120%;
  background-position: top;
  background-size: cover;
  position: relative;
}
.VueCarousel-navigation-button.VueCarousel-navigation-next {
  background: #eee;
}

.cs-carousel {
  display: flex;
  .cs-carousel-main {
    width: calc(100% - 60px);
  }

  .cs-carousel-images {
    width: 60px;

    .image-item {
      height: 50px;
      width: 50px;
      margin: 0 5px 5px;
      cursor: pointer;
      background-position: top;
      background-size: cover;
      position: relative;
      transition: 0.1s;
      border: 2px solid #fff;

      &:hover,
      &.active {
        border: 2px solid #03a9f4;
      }
    }
  }
}
</style>
