  
<template>
  <div>
    <progress-bar
      v-for="(tender_section, index) in data.tender_sections"
      :key="tender_section.Name"
      :title="tender_section.Name"
      :number="tender_section.Amount"
      :total="data.total"
      :bg="$root.colors[index%$root.colors.length]"
    ></progress-bar>
    <hr />
    <center>
      <strong>Source of the files</strong>
    </center>
    <br />
    <progress-bar
      title="Internal"
      :number="data.internal_file"
      :total="data.total"
      :bg="$root.colors[5]"
    ></progress-bar>
    <progress-bar
      title="External"
      :number="data.external_file"
      :total="data.total"
      :bg="$root.colors[0]"
    ></progress-bar>
    <hr />
    <strong>Total: {{data.total}}</strong>
    <hr />
    <center>
      <download-csv
        v-if="data.date!=undefined"
        class="btn btn-success btn-icon-split"
        :data="data.tender_sections"
        :name="'Tender-section('+this.$options.filters.date(data.date)+') - Laravel vue project.csv'"
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
    axios.get("detail_tender").then((response) => {
      this.data = response.data;
    });
  },
};
</script>