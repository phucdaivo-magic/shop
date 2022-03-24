<template>
  <a
    class="position-relative cart-icon mx-2 text-dark"
    :class="icon"
    :href="link"
  >
    <span v-if="count" class="cs-badge" v-html="count"></span>
  </a>
</template>

<script>
export default {
  props: ["count", "link", "icon"],
};
</script>
