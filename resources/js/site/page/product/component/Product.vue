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
                v-lazy:background-image="image.avatar"
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
                v-lazy:background-image="image.avatar"
              ></div>
            </slide>
          </carousel>
        </div>
      </div>

      <div class="col-md-6">
        <slot name="about"></slot>
        <h3 class="text-danger">{{ getPrice | currency("", 0) }} VND</h3>
        <template v-for="product_property_type in product.product_property_types">
          <div class="form-group" :key="product_property_type.id">
            <label class="d-block">
              {{ product_property_type.name }}:
              <template>
                <span class="font-weight-bold">{{
                  getPriceDetail[property[product_property_type.id]].name
                }}</span>
                <span v-if="getPriceDetail[property[product_property_type.id]].price"
                  >, giá chênh lệch
                  <span class="text-danger font-weight-bold"
                    >{{
                      getPriceDetail[property[product_property_type.id]].price
                        | currency("", 0)
                    }}
                    VND</span
                  ></span
                >
              </template>
            </label>
            <!-- RADIO -->
            <template v-if="product_property_type.type == 'color_property'">
              <label
                v-for="(
                  product_property_detail, key
                ) in product_property_type.product_property_details"
                :key="key"
                :title="product_property_detail.name"
                class="prop-radio"
                @click="onChangeDetail(product_property_detail)"
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
                @change="
                  onChangeDetailSelecbox(
                    product_property_type,
                    property[product_property_type.id]
                  )
                "
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

            <!-- LIST RADIO -->
            <template
              v-else-if="
                product_property_type.type_element == 'radio' &&
                product_property_type.type == 'text_property'
              "
            >
              <!-- <select
                v-model="property[product_property_type.id]"
                class="form-control rounded-0"
                @change="
                  onChangeDetailSelecbox(
                    product_property_type,
                    property[product_property_type.id]
                  )
                "
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
              </select> -->
              <fieldset class="form-group">
                <div class="row">
                  <div class="col-sm-10">
                    <label
                      class="form-check"
                      v-for="(
                        product_property_detail, key
                      ) in product_property_type.product_property_details"
                      :key="key"
                      :title="product_property_detail.name"
                    >
                      <input
                        class="form-check-input"
                        type="radio"
                        v-model="property[product_property_type.id]"
                        :name="product_property_detail.id + 'd'"
                        :value="product_property_detail.id"
                      />
                      <span class="form-check-label">{{
                        product_property_detail.name
                      }}</span>
                    </label>
                  </div>
                </div>
              </fieldset>
            </template>

            <!-- IMAGE -->
            <template v-else-if="product_property_type.type == 'image_property'">
              <div class="row">
                <label
                  v-for="(
                    product_property_detail, key
                  ) in product_property_type.product_property_details"
                  class="col-6 prop-image-box"
                  @click="onChangeDetail(product_property_detail)"
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
                    v-lazy:background-image="product_property_detail.image"
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
        <div class="d-flex flex-column flex-md-row">
          <InputNumber v-model="mount" />
          <button class="ml-md-3 mt-2 mt-md-0 w-auto w-md-100 btn btn-danger d-block rounded-0" @click="addToCart">
            <i class="pe-7s-cart mr-2" aria-hidden="true"></i>Thêm vào giỏ hàng
          </button>
          <button class="btn btn-light ml-md-1 rounded-0 w-auto w-md-100 mt-2 mt-md-0"
              @click.stop.prevent="updateFavorite">
            <div
              class="cart-favorite mx-2 fa"
              :class="{
                'fa-heart-o': !isFavorite,
                'fa-heart': isFavorite,
              }"
            ></div>
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
          <div class="btn-group-bot">
            <button
              class="rounded-0 btn btn-primary font-weight-bold mr-2 text-white mt-1"
              data-dismiss="modal"
            >
              Tiếp tục mua hàng
            </button>
            <a
              v-if="slotProps.mount"
              href="/thanh-toan"
              class="rounded-0 btn btn-danger font-weight-bold text-white mt-1"
            >
              Tiến hành thanh toán</a
            >
          </div>
        </div>
      </cart>
    </Modal>
  </div>
</template>

<script>
import InputNumber from "../../../components/InputNumber";
import cart from "../../../utils/cart";
import Modal from "../../../components/Modal";
import favorite from "../../../utils/favorite";

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
      price: 0,
      isFavorite: favorite.getListFavorite().includes(String(this.product.id)),
    };
  },
  props: ["product"],
  created() {
    console.log(this.product);
    this.initProperty();
  },
  computed: {
    getPrice() {
      const priceDetail = this.getPriceDetail;
      return Object.keys(this.property).reduce((acc, cur) => {
        return Number(acc) + Number(priceDetail[this.property[cur]].price || 0);
      }, this.product.price);
    },

    getPriceDetail() {
      return this.product.product_property_types.reduce((acc, cur) => {
        return {
          ...acc,
          ...cur.product_property_details.reduce((acc, cur) => {
            acc[cur.id] = { price: Number(cur.price), name: cur.name || "" };
            return acc;
          }, {}),
        };
      }, {});
    },
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

      // console.log(this.property);

      // this.$refs.cart.loadData()

      this.$root.updateCart();
    },

    updateFavorite() {
      if (this.isFavorite) {
        favorite.removeFavorite(this.product.id);
        this.isFavorite = false;
      } else {
        favorite.pushFavorite(this.product.id);
        this.isFavorite = true;
      }

      this.$root.updateFavorite();
    },

    pageChange(navigateTo) {
      this.navigateTo = navigateTo;
    },

    onChangeDetail(detail) {
      // console.log(detail);
      this.chageImage(detail);
    },

    onChangeDetailSelecbox(type, detailId) {
      const detail = type.product_property_details.find((item) => detailId == item.id);
      // console.log(detail);
      this.chageImage(detail);
    },

    chageImage(detail) {
      const productImageIndex = this.product.images.findIndex(
        (p) => detail.product_image && p.id == detail.product_image.id
      );
      if (productImageIndex > -1) this.navigateTo = productImageIndex;
    },

  },
};
</script>

<style lang="scss">
.prop-radio {
  .radio-color {
    opacity: 0.6;
    //border: 1px solid rgba(0, 0, 0, 0.1);
    width: 30px;
    height: 30px;
    transition: 0.3s;
    cursor: pointer;
    border-radius: 100px;
    box-shadow: inset 0px 0px 5px rgba(0, 0, 0, 0.4);
  }

  .radio-color:hover {
    opacity: 0.9;
  }

  .radio:checked + .radio-color {
    opacity: 1 !important;
    border: 1px solid #000 !important;
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
    border: 2px solid #eee;
    background-size: cover;
    background-position: center;
    text-shadow: 0 0 3px rgb(0 0 0);
    font-weight: bold;
    color: #fff;
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

@media (max-width: 576px) {
  thead {
    display: none !important;
  }
  td {
    display: block;
    border: none !important;
    width: 100%;
  }
  tr {
    margin-top: 10px;
    border: 1px solid #eee;
    padding: 10px 5px;
    &:nth-of-type(odd) {
      background: #fafafa;
    }
  }

  .btn-remove {
    display: block !important;
  }

  .btn-group-bot {
    display: flex;

    .btn {
      flex: 1;
      margin: 0;
      font-size: 12px;
    }
  }



  .text-center.td-remove {
    display: none !important;
  }
}
</style>
