  
<template>
  <div>
    <progress-bar
      title="With link"
      :number="data.with_link"
      :total="data.total"
      :bg="$root.colors[0]"
    ></progress-bar>
    <progress-bar
      title="Without link"
      :number="data.total - data.with_link"
      :total="data.total"
      :bg="$root.colors[1]"
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
    axios.get("detail_advertisement").then((response) => {
      this.data = response.data;
    });
  },
};
</script>