<template>
  <div>
    <div v-for="prop in property" :key="prop['propertyDetailId']" class="text-muted">
       <span>{{ prop['propertyTypeName'] }}:</span>
       <span>{{ prop['propertyDetailName'] }}</span>
    </div>
  </div>
</template>

<script>
export default {
  props: [
    'property'
  ]
}
</script>