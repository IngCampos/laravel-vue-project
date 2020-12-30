  
<template>
  <button v-on:click="Create_tender_section()" class="btn btn-secondary btn-icon-split">
    <span class="icon text-white-50">
      <i class="fa fa-folder"></i>
    </span>
    <span class="text">Create section</span>
  </button>
</template>

<script>
export default {
  methods: {
    Create_tender_section() {
      this.$swal
        .mixin(this.$root.MixinContent(["1", "2"]))
        .queue([
          {
            title: "Add section.",
            text: "Select the type of tender.",
            input: "radio",
            inputOptions: {
              true: "International",
              false: "National",
            },
            inputPlaceholder: "Select",
            showCancelButton: true,
            inputValidator: (value) => {
              return new Promise((resolve) => {
                if (value != null) {
                  resolve();
                } else {
                  resolve("An option should be selected.");
                }
              });
            },
          },
          {
            title: "Add section.",
            text: "Select the year",
            input: "select",
            html:
              "<date-picker type='year' placeholder='Select year'></date-picker>",
            inputOptions: {
              2021: 2021,
              2020: 2020,
              2019: 2019,
              2018: 2018,
              2017: 2017,
              2016: 2016,
              2015: 2015,
            },
            // TODO: Change the input in order to have more years
            inputPlaceholder: "Select",
            showCancelButton: true,
            inputValidator: (value) => {
              return new Promise((resolve) => {
                if (value != "") {
                  resolve();
                } else {
                  resolve("An option should be selected.");
                }
              });
            },
          },
        ])
        .then((result) => {
          if (result.value) {
            this.Add({
              isFederal: result.value[0],
              year: result.value[1],
            });
          }
        });
    },
    Add(data) {
      this.$root.BasicLoading();
      axios.post("api/tender_section", data).then(
        (response) => {
          this.$emit("create", response.data);
          this.$root.SuccessMessage("Section added!");
        },
        (error) => {
          this.$root.ErrorMessage("", error);
        }
      );
    },
  },
};
</script>