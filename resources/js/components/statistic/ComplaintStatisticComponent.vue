  
<template>
  <div>
    <p>Range of date:</p>
    <date-picker
      :disabled="disablePicker"
      style="width:100%"
      v-model="date"
      value-type="format"
      format="YYYY-MM-DD"
      :disabled-date="beetweenTodayAndLastElementbeetweenTodayAndLastComplaint"
      range
      placeholder="Select the range of date"
    ></date-picker>
    <div v-show="showDate">
      <br />
      <progress-bar
        v-for="(type, index) in data.complaint_types"
        :key="type.Type"
        :title="type.Type"
        :number="type.Amount"
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
          :data="data.complaint_types"
          :name="'Type-complaint from '+date[0]+''+ (date[0]!=date[1] ?' to '+ date[1] : '')+' Laravel vue project.csv'"
        >
          <span class="icon text-white-50">
            <i class="fas fa-file-excel"></i>
          </span>
          <span class="text">Download report</span>
        </download-csv>
      </center>
    </div>
    <div v-show="!showDate && date[0]!=null">There are not data.</div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      data: [],
      date: [null, null],
      showDate: false,
      disablePicker: true,
      today: new Date(),
      last_complaint: new Date(),
    };
  },
  watch: {
    date: function (val) {
      //if the dates are set in null, the request is not done
      if (val[0] != null && val[1] != null) {
        axios.get(`detail_complaint/${val}`).then((response) => {
          this.data = response.data;
          // if there are not data, the section does not show nothing.
          if (this.data.total != 0) this.showDate = true;
          else this.showDate = false;
        });
      }
    },
  },
  methods: {
    beetweenTodayAndLastElementbeetweenTodayAndLastComplaint(date) {
      return date > this.today || date < this.last_complaint;
    },
  },
  created: function () {
    axios.get("data_dates_complaint").then((response) => {
      var today_auxiliar = response.data[0];
      var splitDateToday = today_auxiliar.split("-");
      this.today.setHours(0, 0, 0, 0);
      this.today.setFullYear(splitDateToday[0]);
      this.today.setMonth(splitDateToday[1] - 1);
      this.today.setDate(splitDateToday[2]);

      var last_complaint_auxiliar = response.data[1];
      var splitDateLast = last_complaint_auxiliar.split("-");
      this.last_complaint.setHours(0, 0, 0, 0);
      this.last_complaint.setFullYear(splitDateLast[0]);
      this.last_complaint.setMonth(splitDateLast[1] - 1);
      this.last_complaint.setDate(splitDateLast[2]);

      this.disablePicker = false;
    });
  },
};
</script>