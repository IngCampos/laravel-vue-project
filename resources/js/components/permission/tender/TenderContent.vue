  
<template>
  <div>
    <div style="overflow-x:auto;">
      <table style="width:100%" class="table">
        <thead>
          <th style="min-width:270px">
            Name(link)
            <i class="fas fa-sort-alpha-down"></i>
          </th>
          <th class="text-center">Source</th>
          <th style="min-width:125px" class="text-right">Actions</th>
        </thead>
        <tender-section
          v-for="(section, index) in sections"
          :key="index"
          :section="section"
          @update="Update_section(index, ...arguments)"
          @delete_section="Delete_section(index)"
        ></tender-section>
      </table>
      <!-- TODO: Special pagination -->
    </div>
    <div>
      <button v-on:click="Create_internal_file()" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
          <i class="fas fa-file-upload"></i>
        </span>
        <span class="text">Add internal file</span>
      </button>
      <button v-on:click="Create_external_file()" class="btn btn-success btn-icon-split">
        <span class="icon text-white-50">
          <i class="fas fa-link"></i>
        </span>
        <span class="text">Add external file</span>
      </button>
      <tender-creation-section @create="Create_section(...arguments)"></tender-creation-section>
    </div>
  </div>
</template>

<script>
export default {
  props: ["data"],
  methods: {
    Create_internal_file() {
      this.$swal
        .mixin(this.$root.MixinContent(["1", "2", "3"]))
        .queue([
          {
            title: "Add internal file",
            text: "Type the name of the tender.",
            input: "text",
            inputValidator: (value) => {
              return new Promise((resolve) => {
                if (value == "") {
                  resolve("The field cannot be empty.");
                } else {
                  resolve();
                }
              });
            },
          },
          {
            title: "Add internal file.",
            text: "Select the file(just PDF format).",
            input: "file",
            inputValidator: (value) => {
              return new Promise((resolve) => {
                if (value == null) {
                  resolve("A file should be selected.");
                } else if (value.type != "application/pdf") {
                  resolve("The file has to be PDF.");
                } else if (value.size / 1024 / 1024 > 24) {
                  resolve("The maximum allowed file size is 25MB.");
                } else {
                  resolve();
                }
              });
            },
          },
          {
            title: "Add internal file.",
            input: "select",
            inputOptions: this.name_sections,
            inputPlaceholder: "Select the section",
            showCancelButton: true,
            inputValidator: (value) => {
              return new Promise((resolve) => {
                if (value != "") {
                  resolve();
                } else {
                  resolve("A section should be selected.");
                }
              });
            },
          },
        ])
        .then((result) => {
          if (result.value) {
            var fileReader = new FileReader();
            fileReader.readAsDataURL(result.value[1]);
            fileReader.onload = (e) => {
              this.$root.FileLoading(
                "<strong>Name: </strong>" +
                  result.value[0] +
                  "<br><strong>Section: </strong>" +
                  this.name_sections[result.value[2]] +
                  "<br><strong>Name(file): </strong>" +
                  result.value[1].name +
                  "<br><strong>Size(file): </strong>" +
                  Math.round(result.value[1].size / 1024 / 1024) +
                  " MB"
              );
              this.Add({
                internal_file: 1,
                name: result.value[0],
                tender_section_id: result.value[2],
                name_file: result.value[1].name,
                file: e.target.result,
              });
            };
          }
        });
    },
    Create_external_file() {
      this.$swal
        .mixin(this.$root.MixinContent(["1", "2", "3"]))
        .queue([
          {
            title: "Add external file",
            text: "Type the name of the tender.",
            input: "text",
            inputValidator: (value) => {
              return new Promise((resolve) => {
                if (value == "") {
                  resolve("The field cannot be empty.");
                } else {
                  resolve();
                }
              });
            },
          },
          {
            title: "Add external file.",
            text: "Type the url of the file.",
            input: "text",
            inputValidator: (value) => {
              return new Promise((resolve) => {
                if (value == "") {
                  resolve("The field cannot be empty.");
                } else {
                  resolve();
                }
              });
            },
          },
          {
            title: "Add external file.",
            input: "select",
            inputOptions: this.name_sections,
            inputPlaceholder: "Select the section",
            showCancelButton: true,
            inputValidator: (value) => {
              return new Promise((resolve) => {
                if (value != "") {
                  resolve();
                } else {
                  resolve("A section should be selected.");
                }
              });
            },
          },
        ])
        .then((result) => {
          if (result.value) {
            this.$root.BasicLoading();
            this.Add({
              internal_file: 0,
              name: result.value[0],
              tender_section_id: parseInt(result.value[2]),
              link: result.value[1],
            });
          }
        });
    },
    Add(data) {
      axios.post("api/tender", data).then(
        (response) => {
          for (let index = 0; index < this.sections.length; index++) {
            if (this.sections[index].id == data.tender_section_id) {
              this.sections[index].tenders.push(response.data);
              this.sections[index].tenders.orderByString("name");
              break;
            }
          }
          this.$root.SuccessMessage("Tender added!");
        },
        (error) => {
          this.$root.ErrorMessage("", error);
        }
      );
    },
    Create_section(data) {
      this.sections.push(data);
      this.sections.orderByNumber("year", -1);
      this.name_sections[data.id] = data.name;
      this.$forceUpdate();
    },
    Update_section(index, data) {
      this.sections[index].isInternational = data.isInternational;
      this.sections[index].year = data.year;
      this.sections.orderByNumber("year", -1);
      this.$forceUpdate();
    },
    Delete_section(index) {
      this.$swal
        .fire(
          this.$root.ConfirmMessageValue(
            "Are you sure to delete the " + this.sections[index].name,
            "The tenders of this sections are also deleted."
            //TODO: Show how many files are deleted
          )
        )
        .then((result) => {
          if (result.value) {
            this.$root.BasicLoading();
            axios.delete(`api/tender_section/${this.sections[index].id}`).then(
              (response) => {
                this.sections.splice(index, 1);
                this.$root.SuccessMessage("Section deleted!");
              },
              (error) => {
                this.$root.ErrorMessage("", error);
              }
            );
          }
        });
    },
  },
  created() {
    this.sections = JSON.parse(this.data);
    axios.get("api/data_tender_section").then((response) => {
      this.name_sections = response.data;
    });
  },
  data() {
    return {
      sections: [],
      name_sections: [],
    };
  },
};
</script>