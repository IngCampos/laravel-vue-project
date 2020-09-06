  
<template>
  <div>
    <progress-bar
      v-for="(type, index, number) in data.permission_types"
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
  data() {
    return {
      data: [],
    };
  },
  created() {
    axios.get("detail_permission").then((response) => {
      this.data = response.data;
    });
  },
};
</script>