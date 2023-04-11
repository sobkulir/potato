<template lang="">
  <div class="border-gray-500 border-solid border h-4/5 bg-white rounded shadow-inner shadow-sm p-5 overflow-hidden">
    <div class="flex flex-nowrap">
      <CategoryColumn v-for="n in 13" :key="n" />
    </div>
  </div>
</template>
<script>
import CategoryColumn from './CategoryColumn.vue';

export default {
  name: "ContentWrapper",
  components: { CategoryColumn }
}
</script>
