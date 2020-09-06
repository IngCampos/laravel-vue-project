  
<template>
  <div>
    <progress-bar
      v-for="(state, index) in data.machine_states"
      :key="state.State"
      :title="state.State"
      :number="state.Amount"
      :total="data.total"
      :bg="$root.colors[index%$root.colors.length]"
    ></progress-bar>
    <hr />
    <strong>Total: {{data.total}}</strong>
    <hr />
    <center>
      <download-csv
        v-if="data.date!=undefined"
        class="btn btn-success btn-icon-split"
        :data="data.machine_states"
        :name="'Machine-state('+ this.$options.filters.date(data.date) +') - Laravel vue project.csv'"
      >
        <span class="icon text-white-50">
          <i class="fas fa-file-excel"></i>
        </span>
        <span class="text">Download report({{data.date | date}})</span>
      </download-csv>
    </center>
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
    axios.get("detail_machine").then((response) => {
      this.data = response.data;
    });
  },
};
</script>