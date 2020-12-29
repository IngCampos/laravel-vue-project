  
<template>
  <tr>
    <td class="align-middle">
      <a :href="tender.link" target="_blank" rel="noopener noreferrer">{{tender.name}}</a>
      <button v-on:click="Edit(tender.name)" class="btn btn-secondary badge">
        <i class="far fa-edit"></i> Edit
      </button>
      <br />
    </td>
    <td class="align-middle text-center">
      <span v-if="tender.internal_file==1" class="badge badge-primary">Internal</span>
      <span v-else-if="tender.internal_file==0" class="badge badge-success">External</span>
    </td>
    <td class="align-middle text-right">
      <button v-on:click="Show_info()" class="btn btn-info btn-circle">
        <i class="fas fa-info-circle"></i>
      </button>
      <button v-on:click="$emit('delete')" class="btn btn-danger btn-circle">
        <i class="far fa-trash-alt"></i>
      </button>
    </td>
  </tr>
</template>

<script>
export default {
  props: ["tender"],
  methods: {
    Show_info() {
      const date = this.$options.filters.date;
      this.$root.InfoMessage(
        this.tender.name,
        "<strong>Link</strong>: <a href='" +
          this.tender.link +
          "' target='_blank'>" +
          this.tender.link +
          "</a><br><strong>Created at</strong>: " +
          date(this.tender.created_at) +
          "<br><strong>Updated at</strong>: " +
          date(this.tender.updated_at)
      );
    },
    Edit(data) {
      this.$swal
        .fire({
          title: "Edit the name of " + this.tender.name + ".",
          input: "text",
          inputValue: data,
          showCancelButton: true,
          confirmButtonText: "Save",
          inputValidator: (value) => {
            return new Promise((resolve) => {
              if (value == data) {
                resolve("There are not modifications.");
              } else if (value == "") {
                resolve("The field cannot be empty.");
              } else {
                resolve();
              }
            });
          },
        })
        .then((result) => {
          if (result.value) {
            this.$emit("save", { name: result.value });
          }
        });
    },
  },
};
</script>