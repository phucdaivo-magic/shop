<template>
  <div>
    <table class="table table-bordered" v-show="show">
      <thead>
        <tr>
          <th>Sản phẩm</th>
          <th></th>
          <th class="text-right">Tổng cộng</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(product, index) in products" :key="index" v-show="product.show">
          <td width="100">
            <img :src="product.image" alt="" width="100" />
          </td>
          <td>
            {{ product.name }} <strong>x{{ product.mount }}</strong>
            <Property :property="product.propertyDetail" />
          </td>
          <td class="text-right text-muted">
            {{ (product.price * product.mount) | currency("", 0) }} VND
          </td>
        </tr>
        <tr>
          <td colspan="4" class="text-right">
            <div class="d-flex align-items-center justify-content-between">
              <a href="/gio-hang" class="btn rounded-0 btn-light font-weight-bold">Cập nhật giỏ hàng</a>
              <div class="d-flex align-items-center justify-content-between">
                <span class="mr-2"> Tổng cộng: </span>
                <h4 class="m-0">{{ price | currency("", 0) }} VND</h4>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from "axios";
import Property from "../../../components/Property.vue";
import InputNumber from "../../../components/InputNumber.vue";

export default {
  components: {
    Property,
    InputNumber,
  },
  data() {
    return {
      products: [],
      show: false,
    };
  },
  computed: {
    // mount() {
    //   return Object.keys(this.products)
    //     .map((key) => this.products[key])
    //     .reduce(function (acc, cur) {
    //       if (cur.show) acc += Number(cur.mount);
    //       return acc;
    //     }, 0);
    // },
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
        data: this.getCart(),
      });
      console.log(data);
      this.products = data;
      this.show = true;
    },

    getCart() {
      const cart = localStorage.getItem("cart") || "{}";
      return JSON.parse(cart);
    },

    onRemove(index) {
      this.products[index] = false;
      let cartLocal = localStorage.getItem("cart") || "{}";

      cartLocal = JSON.parse(cartLocal);
      delete cartLocal[index];
      localStorage.setItem("cart", JSON.stringify(cartLocal));
    },

    onMount(event, index) {
      let cartLocal = localStorage.getItem("cart") || "{}";

      cartLocal = JSON.parse(cartLocal);
      cartLocal[index] = this.products[index].mount;

      localStorage.setItem("cart", JSON.stringify(cartLocal));
    },
  },
};
</script>

<style scroped>
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
</style>
