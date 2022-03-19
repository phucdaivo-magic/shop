<template>
  <div>
    <div class="row">
      <slot />
      <div class="col-12">
        <div v-if="products.length" class="btn-groups">
          <button
            type="button"
            class="btn btn-ligth ml-auto d-block mb-3 btn-sort px-4"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            {{ sorts[sort] }}
            <span class="pe-7s-filter"></span>
          </button>
          <div class="dropdown-menu dropdown-menu-right">
            <button
              v-for="(sort, key) in sorts"
              :key="key"
              @click="onSort(key)"
              class="dropdown-item"
              type="button"
            >
              {{ sort }}
            </button>
          </div>
        </div>
      </div>
      <div
        v-for="product in products"
        :key="product.id"
        class="col-sm-6 col-md-6 col-lg-4"
      >
        <card-product :product="product"></card-product>
      </div>
    </div>
    <div>
      <vue-infinite-loading @infinite="loadCategoryProduct">
        <!-- <div slot="spinner">Đang lấy thêm sản phẩm</div> -->
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

export default {
  props: ["next"],
  data() {
    return {
      products: [],
      page_url: this.next,
      next_page_url: this.next,
      sort: "new",
      sorts: {
        price: "Giá từ thấp tới cao",
        "price-desc": "Giá từ cao xuống thấp",
        new: "Mới nhất",
      },
    };
  },

  mounted() {
    console.log(this.next);
  },

  methods: {
    async loadCategoryProduct({ loaded, complete }, page) {
      if (this.next_page_url) {
        const { data } = await axios.get(this.next_page_url, {
          params: {
            sort: this.sort,
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

    onSort(sort) {
      this.sort = sort;
      this.next_page_url = this.page_url;
      this.loadCategoryProduct({ loaded: () => {}, complete: () => {} }, 1);
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
