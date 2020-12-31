  
<template>
  <tr v-if="element.id!=undefined">
    <td>
      {{element.order}}
      <button v-on:click="Edit_order()" class="btn badge btn-secondary">
        <i class="far fa-edit"></i> Change
      </button>
    </td>
    <td>
      <center>
        <a :href="element.image_source" target="_blank" rel="noopener noreferrer">
          <img
            style="width:13rem;"
            class="border border-primary rounded"
            :src="element.image_source"
            :alt="element.image_source"
          />
        </a>
      </center>
    </td>
    <td class="col-name">
      <a v-if="element.link!=null" :href="element.link" target="_blank">{{element.link}}</a>
      <a v-else>No link</a>
      <button v-on:click="Edit_link()" class="btn badge btn-secondary">
        <i class="far fa-edit"></i> Edit
      </button>
    </td>
    <td>
      <date-picker
        :class="'badge btn-'+(this.expiration ? (ParseDataDate(expiration) < today?'danger': 'success') : 'secondary')"
        style="width:135px"
        v-model="expiration"
        value-type="format"
        format="YYYY-MM-DD"
        @change="Date_update(...arguments)"
        @clear="Date_update(null)"
        :disabled-date="NotBeforeToday"
        type="date"
        placeholder="Select"
      ></date-picker>
    </td>
    <td class="col-action-2">
      <button v-on:click="Show_info()" class="btn btn-info btn-circle">
        <i class="fas fa-info-circle"></i>
      </button>
      <button v-on:click="$emit('delete', element.id)" class="btn btn-danger btn-circle">
        <i class="far fa-trash-alt"></i>
      </button>
    </td>
  </tr>
  <tr v-else style="background:#f2f2f2">
    <td>{{element.order}}</td>
    <td>
      <center>
        <button v-on:click="Create_element()" class="btn btn-primary btn-icon-split">
          <span class="icon text-white-50">
            <i class="fas fa-image"></i>
          </span>
          <span class="text">Add element</span>
        </button>
      </center>
    </td>
    <td colspan="3"></td>
  </tr>
</template>

<script>
export default {
  props: ["element"],
  methods: {
    Date_update(val) {
      {
        this.expiration = this.expiration_helper;
        this.$swal
          .fire(
            this.$root.ConfirmMessageValue(
              "¿Are you sure to update the expiration date of the element number " +
                this.element.order +
                "?",
              "From " +
                (this.expiration_helper
                  ? this.expiration_helper
                  : "'undefined'") +
                " to <strong>" +
                (val ? val : "'undefined'") +
                "</strong>"
            )
          )
          .then((result) => {
            if (result.value) {
              this.$root.BasicLoading();
              axios
                .put(`api/advertisement/${this.element.id}`, {
                  expiration: val,
                })
                .then(
                  (response) => {
                    this.expiration = val;
                    this.expiration_helper = val;
                    this.$emit("update", response.data);
                    this.$root.SuccessMessage(
                      "Element updated!",
                      response.data.expiration
                        ? "Expiration date: " + val + " 23:59:59"
                        : "Without expiration date"
                    );
                  },
                  (error) => {
                    this.$root.ErrorMessage("", error);
                  }
                );
            }
          });
      }
    },
    Show_info() {
      const date = this.$options.filters.date;
      this.$swal.fire({
        title: "Element number " + this.element.order + ".",
        html:
          "<strong>Link</strong>: " +
          (this.element.link
            ? "<a href='" +
              this.element.link +
              "' target='_blank'>" +
              this.element.link +
              "</a>"
            : "No link") +
          "<br><strong>Created at</strong>: " +
          date(this.element.created_at) +
          "<br><strong>Updated at</strong>: " +
          date(this.element.updated_at) +
          "<br><strong>Expiration date</strong>: " +
          (this.element.expiration ? this.element.expiration : "undefined"),
        imageUrl: this.element.image_source,
        imageWidth: 400,
        imageHeight: 133,
        imageAlt: this.element.image_source,
      });
    },
    Create_element() {
      this.$swal
        .mixin(this.$root.MixinContent(["1", "2"]))
        .queue([
          {
            title: "Image number " + this.element.order + ".",
            text: "Select a file (just JPG or JPEG).",
            input: "file",
            inputValidator: (value) => {
              return new Promise((resolve) => {
                if (value == null) {
                  resolve("An image should be selected..");
                } else if (
                  (value.type == "image/png") |
                  (value.type == "image/jpeg")
                ) {
                  resolve();
                } else {
                  resolve("The image should be PNG or JPEG.");
                }
              });
            },
          },
          {
            title: "Image number " + this.element.order + ".",
            text: "Link(optional) to go when the images is clicked.",
            input: "text",
          },
        ])
        .then((result) => {
          if (result.value) {
            var fileReader = new FileReader();
            fileReader.readAsDataURL(result.value[0]);
            fileReader.onload = (e) => {
              this.Add(
                {
                  order: this.element.order,
                  image_source: result.value[0].name,
                  link: result.value[1],
                  file: e.target.result,
                },
                result.value[0].size / 1024
              );
            };
          }
        });
    },
    Add(data, size) {
      this.$root.FileLoading(
        "<strong>Order: </strong>" +
          data.order +
          "<br><strong>Link: </strong>" +
          data.link +
          "<br><strong>Name(file): </strong>" +
          data.image_source +
          "<br><strong>Size: </strong>" +
          Math.round(size) +
          // TODO: Validate the size image
          " KB"
      );
      axios.post("api/advertisement", data).then(
        (response) => {
          this.$emit("create", response.data);
          this.$root.SuccessMessage(
            "Element created!",
            "In the main panel you could set an expiration date."
          );
        },
        (error) => {
          this.$root.ErrorMessage("", error);
        }
      );
    },
    Edit_order() {
      this.$swal
        .fire({
          title: "Edit the element number " + this.element.order + ".",
          input: "select",
          inputOptions: { 1: 1, 2: 2, 3: 3, 4: 4, 5: 5, 6: 6, 7: 7 },
          inputValue: this.element.order,
          showCancelButton: true,
          confirmButtonText: "Save",
          inputValidator: (value) => {
            return new Promise((resolve) => {
              if (value == this.element.order) {
                resolve("There are not modifications.");
              } else if (value == "") {
                resolve("The name cannot be empty.");
              } else {
                resolve();
              }
            });
          },
        })
        .then((result) => {
          if (result.value) {
            this.Update({ order: result.value });
          }
        });
    },
    Edit_link() {
      this.$swal
        .fire({
          title: "Edit the element number " + this.element.order + ".",
          input: "text",
          inputValue: this.element.link,
          showCancelButton: true,
          confirmButtonText: "Save",
          inputValidator: (value) => {
            return new Promise((resolve) => {
              if (value == this.element.link)
                resolve("There are not modifications.");
              else if (value == "" && this.element.link == null)
                resolve("There are not modifications.");
              else resolve();
            });
          },
        })
        .then((result) => {
          if (result.value == "") {
            this.Update({ link: null });
          } else if (result.value) {
            this.Update({ link: result.value });
          }
        });
    },
    Update(data) {
      this.$root.BasicLoading();
      axios.put(`api/advertisement/${this.element.id}`, data).then(
        (response) => {
          this.$emit("update", response.data);
          this.$root.SuccessMessage("Element updated!");
        },
        (error) => {
          this.$root.ErrorMessage("", error);
        }
      );
    },
    ParseDataDate(date) {
      // input(from database or pickerdate(format YYYY-MM-DD)) : 2020-04-24
      var data = new Date();
      if (date) {
        var splitDate = date.split("-");
        data.setFullYear(splitDate[0]);
        data.setMonth(splitDate[1] - 1);
        data.setDate(splitDate[2]);
        return data;
      } else return [];
      // output(for javascript comparations, Date() format) :
      // Wed May 13 2020 11:10:08 GMT-0500 (Central Daylight Time)
    },
    FillDatePicker() {
      var expiration = new Date();
      if (this.element.expiration) {
        var splitDate = this.element.expiration.split("-");
        expiration.setFullYear(splitDate[0]);
        expiration.setMonth(splitDate[1] - 1);
        expiration.setDate(splitDate[2]);
        expiration = this.element.expiration;
        return expiration;
      } else return null;
    },
    NotBeforeToday(date) {
      return date < this.today;
    },
  },
  data() {
    return {
      expiration: this.FillDatePicker(),
      expiration_helper: this.FillDatePicker(),
      today: new Date(),
    };
  },
  created: function () {
    axios.get("api/date").then((response) => {
      var today_auxiliar = response.data[0];
      var splitDateToday = today_auxiliar.split("-");
      this.today.setHours(0, 0, 0, 0);
      this.today.setFullYear(splitDateToday[0]);
      this.today.setMonth(splitDateToday[1] - 1);
      this.today.setDate(splitDateToday[2]);
    });
  },
  updated: function () {
    this.expiration = this.FillDatePicker();
    this.expiration_helper = this.FillDatePicker();
  },
};
</script>

<style>
.swal2-image {
  border: 1px solid black;
}
</style>