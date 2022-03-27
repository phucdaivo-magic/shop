<template>
  <div>
    <slot />
    <div class="row">
      <!-- <div
        v-for="product in products"
        :key="product.id"
        class="col-sm-4 col-md-2 col-lg-3"
      >
        <card-product :product="product"></card-product>
      </div> -->
      <carousel
        v-if="products[0]"
        class="cs-carousel-main w-100"
        @page-change="() => {}"
        :navigateTo="0"
        :paginationEnabled="false"
        :perPage="4"
        :loop="true"
        :navigationEnabled="true"
        :adjustableHeight="false"
        :autoplay="false"
        :mouseDrag="false"
        :navigationNextLabel="''"
        :navigationPrevLabel="''"
        :perPageCustom="[
          [320, 2],
          [576, 3],
          [768, 4],
          [1199, 4],
        ]"
      >
        <slide v-for="product in products" :key="product.id">
          <div class="p-2">
            <card-product :product="product"></card-product>
          </div>
        </slide>
      </carousel>
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
    };
  },

  mounted() {
    this.loadProduct();
  },

  methods: {
    async loadProduct(page) {
      if (this.next_page_url) {
        const { data } = await axios.get(this.next_page_url, {
          params: {
            per_page: 16,
            ...(page ? { page } : {}),
          },
        });

        this.next_page_url = data.next_page_url;
        this.products = [...this.products, ...data.data];
      } else {
        // TODO errors
      }
    },
  },
};
</script>

<style lang="scss">

</style>
