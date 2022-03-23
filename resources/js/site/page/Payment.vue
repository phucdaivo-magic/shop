<template>
  <div>
      <div v-if="complete">
        <BillAbout :about="about" />
      </div>
      <div class="row flex-wrap-reverse" v-else>
        <div class="col-md-6 mb-4">
          <h4>Thông tin giao hàng</h4>
          <Address v-model="address" @onSubmit="onSubmit" />
        </div>
        <div class="col-md-6">
          <h4>Đơn đặt hàng của bạn</h4>
          <ListProduct @onPayment="onPayment" />
        </div>
      </div>
      <!--
    <div>
      <button class="btn btn-primary font-weight-bold mr-2"> Tiếp tục mua hàng</button>
      <a href="/thanh-toan" class="btn btn-danger font-weight-bold text-white"> Tiến Hành thanh toán</a>
    </div> -->
    </div>
    <!-- <div>
    Vui lòng thêm sản phẩm vào giỏ hàng
  </div> -->
</template>

<script>
import axios from "axios";
import Property from "../components/Property";
import Address from "./payment/component/Address";
import ListProduct from "./payment/component/ListProduct";
import BillAbout from "./payment/component/BillAbout";
// import Swal from 'sweetalert2';

export default {
  components: {
    Property,
    Address,
    ListProduct,
    BillAbout,
  },
  data() {
    return {
      products: [],
      show: false,
      address: {
        payment_method: 1,
      },
      complete: false,
      about: {},
    };
  },
  computed: {
    mount() {
      return Object.keys(this.products)
        .map((key) => this.products[key])
        .reduce(function (acc, cur) {
          acc += Number(cur.mount);
          return acc;
        }, 0);
    },
    price() {
      return Object.keys(this.products)
        .map((key) => this.products[key])
        .reduce(function (acc, cur) {
          acc += Number(cur.mount) * Number(cur.price);
          return acc;
        }, 0);
    },
  },
  methods: {
    getLocalStoreCart() {
      let cartLocal = localStorage.getItem("cart") || "{}";
      return JSON.parse(cartLocal);
    },

    async onPayment() {
      console.log(this.address, this.getLocalStoreCart());
      const { data } = await axios.post("payment", {
        cart: this.getLocalStoreCart(),
        address: this.address,
      });

      this.complete = true;

      this.about = data;
      console.log(data);
      //  Swal.fire({
      //       title: 'Đặt hàng thành công',
      //       type: 'warning',
      //       showCancelButton: true,
      //       confirmButtonColor: '#3085d6',
      //       cancelButtonColor: '#d33',
      //       confirmButtonText: 'Xóa'
      //   }).then((result) => {

      //   });
    },

    onSubmit() {
      this.onPayment();
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
