  
<template>
  <tr>
    <td>
      {{ add.id}}
    </td>
    <td class="text-center">
      <a :href="add.image_source" target="_blank" rel="noopener noreferrer">
        <img
          style="width:10rem;"
          class="border border-primary rounded"
          :src="add.image_source"
          :alt="add.image_source"
        />
      </a>
    </td>
    <td class="col-name">
      <a v-if="add.link!=null" :href="add.link" target="_blank">{{add.link}}</a>
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
      <button v-on:click="$emit('delete', add.id)" class="btn btn-danger btn-circle">
        <i class="far fa-trash-alt"></i>
      </button>
    </td>
  </tr>
</template>

<script>
export default {
  props: ["add"],
  methods: {
    Date_update(val) {
      {
        this.expiration = this.expiration_helper;
        this.$swal
          .fire(
            this.$root.ConfirmMessageValue(
              "¿Are you sure to update the expiration date of the add id " +
                this.add.order +
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
                .put(`api/advertisement/${this.add.id}`, {
                  expiration: val,
                })
                .then(
                  (response) => {
                    this.expiration = val;
                    this.expiration_helper = val;
                    this.$emit("update", response.data);
                    this.$root.SuccessMessage(
                      "Add updated!",
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
        title: "Add id " + this.add.order + ".",
        html:
          "<strong>Link</strong>: " +
          (this.add.link
            ? "<a href='" +
              this.add.link +
              "' target='_blank'>" +
              this.add.link +
              "</a>"
            : "No link") +
          "<br><strong>Created at</strong>: " +
          date(this.add.created_at) +
          "<br><strong>Updated at</strong>: " +
          date(this.add.updated_at) +
          "<br><strong>Expiration date</strong>: " +
          (this.add.expiration ? this.add.expiration : "undefined"),
        imageUrl: this.add.image_source,
        imageWidth: 400,
        imageHeight: 133,
        imageAlt: this.add.image_source,
      });
    },
    Edit_link() {
      this.$swal
        .fire({
          title: "Edit the add id " + this.add.order + ".",
          input: "text",
          inputValue: this.add.link,
          showCancelButton: true,
          confirmButtonText: "Save",
          inputValidator: (value) => {
            return new Promise((resolve) => {
              if (value == this.add.link)
                resolve("There are not modifications.");
              else if (value == "" && this.add.link == null)
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
      axios.put(`api/advertisement/${this.add.id}`, data).then(
        (response) => {
          this.$emit("update", response.data);
          this.$root.SuccessMessage("Add updated!");
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
      if (this.add.expiration) {
        var splitDate = this.add.expiration.split("-");
        expiration.setFullYear(splitDate[0]);
        expiration.setMonth(splitDate[1] - 1);
        expiration.setDate(splitDate[2]);
        expiration = this.add.expiration;
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