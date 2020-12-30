  
<template>
  <div>
    <progress-bar
      v-for="(type, index, number) in data.types"
      :key="index"
      :title="index"
      :number="type"
      :total="data.total"
      :bg="$root.colors[number%$root.colors.length]"
    ></progress-bar>
    <hr />
    <strong>Total: {{data.total}}</strong>
  </div>
</template>

<script>
export default {
  props: ["data"],
};
</script>