  
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
    <hr />
    <center>
      <download-csv
        class="btn btn-success btn-icon-split"
        :data="download_content"
        :name="(file_name ? file_name : 'Type data') +' Laravel vue project.csv'"
      >
        <span class="icon text-white-50">
          <i class="fas fa-file-excel"></i>
        </span>
        <span class="text">Download report</span>
      </download-csv>
    </center>
  </div>
</template>

<script>
export default {
  props: ["data", "file_name", "column_name_type"],
  data() {
    return {
      download_content: [],
    };
  },
  created() {
    for (const key in this.data.types) {
      var Type = new Object();
      Type[this.column_name_type ? this.column_name_type : "Type"] = key;
      Type["Amount"] = this.data.types[key];
      this.download_content.push(Type);
    }
  },
};
</script>