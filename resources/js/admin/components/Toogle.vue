<template>
  <div
    class="cs-toggle"
    :class="{ checked }"
    :cs-request="request"
  ></div>
</template>

<script>
export default {
  props: [
    'checked',
    'request',
  ],
  mounted() {
    csInitToggle(this.$el);
  }
};
</script>
