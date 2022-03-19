<template>
  <div>
    <table class="table table-bordered" v-show="show">
      <thead>
        <tr>
          <th>Sản phẩm</th>
          <th></th>
          <th class="text-right">Giá</th>
          <th class="text-center">Số lượng</th>
          <th class="text-right">Tổng cộng</th>
          <th class="text-center">Xoá</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(product, index) in products" :key="index" v-show="product.show">
          <td width="100">
            <a :href="`${BASE_URL}/san-pham/${product.id}-${product.slug}.html`">
              <img :src="product.image" alt="" width="100" />
            </a>
          </td>
          <td>
            {{ product.name }}
            <Property :property="product.propertyDetail" />
          </td>
          <td class="text-muted text-right">{{ product.price | currency("", 0) }} VND</td>
          <td class="text-right text-muted" width="100">
            <InputNumber v-model="product.mount" @input="onMount(index)" />
          </td>
          <td class="text-right text-muted">
            {{ (product.price * product.mount) | currency("", 0) }} VND
          </td>
          <td class="text-center">
            <button class="btn text-danger btn-remove btn-light" @click="onRemove(index)">
              <i class="pe-7s-close icon-remove"></i>
            </button>
          </td>
        </tr>
        <tr>
          <td></td>
          <td></td>

          <td colspan="3" class="text-right">
            <div class="d-flex align-items-center justify-content-end">
              <span class="mr-2"> Tổng cộng: </span>
              <h4 class="m-0">{{ price | currency("", 0) }} VND</h4>
            </div>
          </td>
          <td></td>
        </tr>
      </tbody>
    </table>
    <slot v-bind:mount="mount" />
  </div>
</template>

<script>
import axios from "axios";
import Property from "../components/Property.vue";
import InputNumber from "../components/InputNumber.vue";
import cart from "../utils/cart";

export default {
  components: {
    Property,
    InputNumber,
  },
  data() {
    return {
      products: [],
      show: false,
      BASE_URL,
    };
  },
  computed: {
    mount() {
      return Object.keys(this.products)
        .map((key) => this.products[key])
        .reduce(function (acc, cur) {
          if (cur.show) acc += Number(cur.mount);
          return acc;
        }, 0);
    },
    price() {
      return Object.keys(this.products)
        .map((key) => this.products[key])
        .reduce(function (acc, cur) {
          if (cur.show) acc += Number(cur.mount) * Number(cur.price);
          return acc;
        }, 0);
    },
  },
  mounted() {
    this.loadData();
  },
  methods: {
    async loadData() {
      const { data } = await axios.post(BASE_URL + "/list-cart", {
        data: cart.getCart(),
      });
      console.log(data);
      this.products = data;
      this.show = true;
    },

    onRemove(index) {
      this.products[index] = false;
      let cartLocal = cart.getCart();
      delete cartLocal[index];
      cart.setCart(cartLocal);
    },

    onMount(index) {
      let cartLocal = cart.getCart();
      cartLocal[index] = this.products[index].mount;
      cart.setCart(cartLocal);
    },
  },
};
</script>

<style lang="scss" scroped>
.table-bordered {
  font-size: 14px;
}
.table-bordered td,
.table-bordered th {
  border-right: 0;
  border-left: 0;
}
.table-bordered thead th {
  border-bottom-width: 1px;
}

.table-bordered td {
  vertical-align: middle;
}

.btn-remove {
  display: flex;
  justify-content: center;
  align-items: center;
  .icon-remove {
    font-size: 23px;
  }
}
</style>
