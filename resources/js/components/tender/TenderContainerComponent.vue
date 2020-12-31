  
<template>
  <tbody>
    <tr class="section-row">
      <td colspan="2" class="text-center">
        <span class="badge section-badge">{{section.name}}</span>
      </td>
      <td class="col-action-2">
        <button v-on:click="Edit_section()" class="btn btn-secondary btn-circle">
          <i class="far fa-edit"></i>
        </button>
        <button v-on:click="$emit('delete_section')" class="btn btn-danger btn-circle">
          <i class="far fa-trash-alt"></i>
        </button>
      </td>
    </tr>
    <tender-row
      v-for="(tender, index) in section.tenders"
      :key="index"
      @delete="Delete(index)"
      @save="Save(index,...arguments)"
      :tender="tender"
    ></tender-row>
  </tbody>
</template>

<script>
export default {
  props: ["section"],
  methods: {
    Delete(index) {
      this.$swal
        .fire(
          this.$root.ConfirmMessageValue(
            "Are you sure to delete " + this.section.tenders[index].name + "?",
            "The file in the server is also deleted."
          )
        )
        .then((result) => {
          if (result.value) {
            this.$root.BasicLoading();
            axios.delete(`api/tender/${this.section.tenders[index].id}`).then(
              (response) => {
                this.section.tenders.splice(index, 1);
                this.$root.SuccessMessage("Tender deleted!");
              },
              (error) => {
                this.$root.ErrorMessage("", error);
              }
            );
          }
        });
    },
    Save(index, data) {
      this.$root.BasicLoading();
      axios.put(`api/tender/${this.section.tenders[index].id}`, data).then(
        (response) => {
          this.section.tenders[index] = response.data;
          this.section.tenders.orderByString("name");
          this.$forceUpdate();
          this.$root.SuccessMessage("Tender updated!");
        },
        (error) => {
          this.$root.ErrorMessage("", error);
        }
      );
    },
    Edit(data) {
      this.$root.BasicLoading();
      axios.put(`api/tender_section/${this.section.id}`, data).then(
        (response) => {
          this.$emit("update", response.data);
          this.$root.SuccessMessage("Section updated!");
        },
        (error) => {
          this.$root.ErrorMessage("", error);
        }
      );
    },
    Edit_section() {
      var years = "";
      // html code for the option inputs
      for (var i = 2015; i < 2021; i++) {
        years += "<option value='" + i + "'";
        // if the year is the current, it is selected
        if (i == this.section.year) years += " selected";
        years += ">" + i + "</option>";
      }
      this.$swal.fire({
        title: "Edit section " + this.nametender,
        html:
          "Tipo: <div class=''>" +
          "<label><input type='radio' name='type' value=1 " +
          (this.section.isInternational ? "checked" : "") +
          "><span class='swal2-label'>International</span></label>" +
          "<label><input type='radio' name='type' value=0 " +
          (this.section.isInternational ? "" : "checked") +
          "><span class='swal2-label'>National</span></label>" +
          "<br>" +
          "Año:<select class='swal2-input' id='year'>" +
          years +
          "</select>",
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: "Save",
        preConfirm: () => {
          this.Edit({
            isInternational: $("input[name=type]:checked").val(),
            year: document.getElementById("year").value,
          });
        },
      });
    },
  },
};
</script>
<style scoped>
.swal2-radio-helper {
  align-items: center;
  justify-content: center;
  background: #fff;
  color: inherit;
  margin: 1em auto;
}
</style>