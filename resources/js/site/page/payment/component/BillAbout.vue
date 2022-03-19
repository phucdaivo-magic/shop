<template>
  <div>
    <div class="alert alert-success rounded-0" role="alert">
      <h5>
        Cảm ơn bạn, Đơn hàng của bạn đã được xác nhận, chúng tôi sẽ tiến hành đóng
        gói và chuyển đến bạn sớm nhất.
      </h5>
    </div>
    <h3>Chi tiết đơn hàng #{{ about.id }}</h3>
    <h4 class="ml-auto">{{ about.date }}</h4>

    <table class="table table-bordered" v-if="about">
      <thead>
        <tr>
          <th>Sản phẩm</th>
          <!-- <th></th> -->
          <th class="text-right">Tổng cộng</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="bill_product in about.bill_products" :key="bill_product.id">
          <!-- <td width="100">
            <img :src="bill_product.product.avatar" alt="" width="100" />
          </td> -->
          <td>
            {{ bill_product.product.name }} <strong>x{{ bill_product.mount }}</strong>
            <Property :property="getProperty(bill_product.bill_product_details)" />
          </td>
          <td class="text-right text-muted">
            {{ (bill_product.current_price * bill_product.mount) | currency("", 0) }}
            VND
          </td>
        </tr>
        <tr>
          <th>Phí ship</th>
          <td class="text-right text-muted">
            {{ about.shipping_price | currency("", 0) }} VND
          </td>
        </tr>

        <tr>
          <td></td>

          <td colspan="2" class="text-right">
            <div class="d-flex align-items-center justify-content-end">
              <span class="mr-2"> Tổng cộng: </span>
              <h4 class="m-0">{{ about.total_price | currency("", 0) }} VND</h4>
            </div>
          </td>
        </tr>
        <tr>
          <th>Phương thức thanh toán</th>
          <td class="text-right text-muted">
            {{ getPaymentMethod(about.payment_method) }}
          </td>
        </tr>
      </tbody>
    </table>
    <div>
      <a :href="BASE_URL" class="btn btn-primary rounded-0">Tiếp tục mua hàng</a>
    </div>
  </div>
</template>

<script>
import Property from "../../../components/Property.vue";
import { SHIPPING_METHOD } from "../../../consts/method";
export default {
  components: {
    Property,
  },
  props: {
    about: {},
  },
  data() {
    return {
      BASE_URL
    }
  },
  methods: {
    getProperty(bill_product_details) {
      return bill_product_details.map((detail) => ({
        propertyDetailId: detail.product_property_detail.id,
        propertyDetailName: detail.product_property_detail.name,
        propertyTypeId: detail.product_property_type.id,
        propertyTypeName: detail.product_property_type.name,
      }));
    },
    getPaymentMethod(id) {
      return SHIPPING_METHOD.find((method) => method.id == id).name;
    },
  },
};
</script>
