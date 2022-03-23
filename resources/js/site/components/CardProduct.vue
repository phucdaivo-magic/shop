<template>
  <a :href="link" class="card-product">
    <div class="image" :style="{ backgroundImage: `url('${avatar}')` }">
      <div class="image-list">
        <template v-if="product.images.length > 1">
          <div
            v-for="image in product.images.slice(0, 3)"
            :key="image.id"
            :style="{ backgroundImage: `url('${image.avatar}')` }"
            :class="{ active: avatar == image.avatar }"
            class="image-list-item"
            @click.stop.prevent="updateAvatar(image)"
            @mouseenter="updateAvatar(image)"
          ></div>
        </template>
      </div>
    </div>
    <div>
      <div class="name text-danger text-muted">{{ product.name }}</div>
      <div class="price text-danger">{{ product.price || 0 | currency("", 0) }} VND</div>
    </div>
  </a>
</template>

<script>
export default {
  props: ["product"],
  data() {
    return {
      avatar: this.product.avatar,
    };
  },
  computed: {
    link() {
      return `${window.BASE_URL}/san-pham/${this.product.id}-${this.product.slug}.html`;
    },
  },
  mounted() {
    console.log(this.product);
  },
  methods: {
    updateAvatar(image) {
      this.avatar = image.avatar;
    },
  },
};
</script>

<style lang="scss" scoped>
.card-product {
  position: relative;
  margin-bottom: 20px;
  cursor: pointer;
  text-decoration: none;
  display: block;

  .image {
    padding-top: 120%;
    background-position: top;
    background-size: cover;
    position: relative;

    .image-list {
      background: linear-gradient(transparent, rgba(0, 0, 0, 0.1));
      height: 100%;
      width: 100%;
      position: absolute;
      left: 0;
      bottom: 0;
      display: flex;
      justify-content: center;
      align-items: flex-end;

      .image-list-item {
        width: 60px;
        height: 60px;
        margin: 15px 5px;
        background-position: center;
        background-size: cover;
        border-radius: 30px;

        &:hover {
        }
        &.active {
          border: 1px solid #ddd;
        }
      }
    }
  }

  .name {
    padding: 5px 0;
  }
}
</style>
