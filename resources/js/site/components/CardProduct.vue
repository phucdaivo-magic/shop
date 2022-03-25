<template>
  <a :href="link" class="card-product">
    <div class="image"
     v-lazy:background-image="avatar">
      <div
        class="cart-favorite mx-2 fa"
        :class="{
          'fa-heart-o': !isFavorite,
          'fa-heart': isFavorite,
        }"
        @click.stop.prevent="updateFavorite"
      ></div>
      <div class="image-list">
        <template v-if="product.images.length > 1">
          <div
            v-for="image in product.images.slice(0, 3)"
            :key="image.id"
            v-lazy:background-image="image.avatar"
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
import favorite from "./../utils/favorite";

export default {
  props: ["product"],
  data() {
    return {
      avatar: this.product.avatar,
      isFavorite: favorite.getListFavorite().includes(String(this.product.id)),
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

    updateFavorite() {
      if (this.isFavorite) {
        favorite.removeFavorite(this.product.id);
        this.isFavorite = false;
      } else {
        favorite.pushFavorite(this.product.id);
        this.isFavorite = true;
      }

      this.$root.updateFavorite();
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

  &:hover {
    .image {
      .image-list {
        background: rgba(0, 0, 0, 0.05);
      }
    }
  }

  .image {
    padding-top: 120%;
    background-position: top;
    background-size: cover;
    position: relative;

    .image-list {
      background: linear-gradient(transparent, rgba(0, 0, 0, 0.05));
      height: 100%;
      width: 100%;
      position: absolute;
      left: 0;
      bottom: 0;
      display: flex;
      justify-content: center;
      align-items: flex-end;
      transition: all 0.5s;

      .image-list-item {
        width: 60px;
        height: 60px;
        background-color: #fff;
        @media (max-width: 993px) {
          width: 40px;
          height: 40px;
        }
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
    .cart-favorite {
      position: absolute;
      top: 0;
      left: 0;
      margin: 10px;
      font-size: 20px;
      color: #fff;
      z-index: 100;
      transition: all 0.5s;

      &:hover {
        color: #c70909;
      }
      &.fa-heart {
        color: #000;
        &:hover {
          color: #c70909;
        }
      }
    }
  }

  .name {
    padding: 5px 0;
  }
}
</style>
