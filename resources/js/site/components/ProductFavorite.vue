<template>
  <div>
    <div class="row">
      <slot />
      <div
        v-for="product in products"
        :key="product.id"
        class="col-6 col-sm-4 col-md-3 col-lg-3"
      >
        <card-product :product="product"></card-product>
      </div>
    </div>
    <div>
      <vue-infinite-loading @infinite="loadCategoryProduct" ref="infinite">

        <div slot="no-more">
          <div class="alert alert-warning mt-4" role="alert">Đã hết sản phẩm.</div>
        </div>
        <div slot="no-results">
          <div class="alert alert-warning mt-4" role="alert">
            Hiện tại máy chủ đang bận, vui lòng tải lại trang.
          </div>
        </div>

      </vue-infinite-loading>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import favorite from "../utils/favorite"

export default {
  props: ["next"],
  data() {
    return {
      products: [],
      page_url: this.next,
      next_page_url: this.next,
    };
  },

  created() {
    /* this.loadCategoryProduct({ loaded: () => {}, complete: () => {} }, 1); */
  },

  methods: {
    async loadCategoryProduct({ loaded, complete }, page) {
      if (this.next_page_url) {
        this.loading = true;
        const { data } = await axios.get(this.next_page_url, {
          params: {
            ids:favorite.getListFavorite(),
            ...(page ? { page } : {}),
          },
        });

        this.next_page_url = data.next_page_url;

        this.page++;
        if (page == 1) this.products = [];
        this.products = [...this.products, ...data.data];
        loaded();
      } else {
        // TODO errors
        complete();
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.btn-sort {
  border-radius: 100px;
  outline: 0;
  &:focus {
    box-shadow: none !important;
  }
}
</style>
