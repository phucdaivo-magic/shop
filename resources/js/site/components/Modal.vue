<template>
  <div>
    <div
      class="modal fade"
      id="exampleModalCenter"
      ref="modal"
      tabindex="-1"
      role="dialog"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-cart" role="document">
        <div class="modal-content rounded-0">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">
              <i class="pe-7s-cart mr-2" aria-hidden="true"></i>Đơn đặt hàng của bạn
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <slot />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["value"],
  watch: {
    value(newValue) {
      if (newValue) {
        $(this.$refs.modal).modal("show");
      } else {
        $(this.$refs.modal).modal("hide");
      }
    },
  },
  mounted() {
    $(this.$refs.modal).modal("show");

    $(this.$refs.modal).on("hidden.bs.modal", (e) => {
      this.$emit("input", false);
    });
  },
  beforeDestroy() {
    $(this.$refs.modal).modal("dispose");
  },
};
</script>

<style lang="scss" scoped>
@media (min-width: 576px) {
  .modal-cart {
    max-width: 800px;
  }
}
</style>
