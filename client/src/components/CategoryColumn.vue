<template lang="">
  <div class="text-xl">
    <CategoryHeader />
    <ColumnItem v-for="n in 5" :key="n"/>
  </div>
</template>
<script>
import CategoryHeader from './CategoryHeader.vue';
import ColumnItem from './ColumnItem.vue';
export default {
  name: "CategoryColumn",
  components: { CategoryHeader, ColumnItem }
}
</script>
