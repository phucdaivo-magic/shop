<template>
  <ValidationObserver ref="observer" v-slot="{ invalid }">
    <CustomForm :form="form" v-model="address" />
    <button class="btn btn-danger btn-lg rounded-0" :disabled="invalid || submitting" @click="validate">Đặt hàng</button>
  </ValidationObserver>
</template>
<script>
import CustomForm from "../../../components/CustomForm.vue";
import { ValidationObserver } from "vee-validate";
import { SHIPPING_METHOD } from "../../../consts/method"

// Validator.localize('en', dict);
// or use the instance method
export default {
  components: { CustomForm, ValidationObserver },
  props: ["value"],
  data() {
    return {
      address: this.value,
      form: {
        name: {
          cssClass: "col-md-12",
          placeholder: "Nhập họ và tên",
          title: "Họ và tên",
          validate: "required",
          required: () => "Họ và tên không được để trống",
        },
        phone: {
          placeholder: "Nhập số điện thoại",
          title: "Số điện thoại",
          validate: "required",
          required: () => "Số điện thoại không được để trống",
        },
        email: {
          placeholder: "Nhập địa chỉ email",
          title: "Địa chỉ email",
          validate: "required|email",
          required: () => "Địa chỉ email không được để trống",
          email: "Nhập chưa đúng định dạng email",
        },
        city: {
          placeholder: "Nhập Tỉnh/Thành phố",
          title: "Tỉnh/Thành phố",
          validate: "required",
          required: () => "Tỉnh/Thành phố không được để trống",
        },
        district: {
          placeholder: "Nhập quận huyện",
          title: "Quận huyện",
          validate: "required",
          required: () => "Quận huyện không được để trống",
        },
        ward: {
          placeholder: "Nhập Xã/Phường/Thị trấn",
          title: "Xã/Phường/Thị trấn",
          validate: "required",
          required: () => "Xã/Phường/Thị trấn không được để trống",
        },
        address: {
          placeholder: "Nhập địa chỉ",
          title: "Địa chỉ",
          validate: "required",
          required: () => "Địa chỉ không được để trống",
        },
        note: {
          cssClass: "col-md-12",
          placeholder: "Nhập ghi chú",
          title: "Ghi chú",
          type: "textarea",
        },
        payment_method: {
          cssClass: "col-md-12",
          title: "Phương thức thanh toán",
          type: "radio",
          dataSource: SHIPPING_METHOD,
        },
      },
      submitting: false
    };
  },
  mounted() {
    this.address = this.value;
  },
  watch: {
    address: function (value) {
      console.log(this.address);
      this.$emit("input", value);
    },
  },
  methods: {
    async validate() {
      const res = await this.$refs["observer"].validate();
      if (res) {
        console.log(this.address);
        this.$emit("onSubmit", this.address);
        this.submitting = true;
      }
    },
  },
};
</script>
