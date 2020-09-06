  
<template>
  <button v-on:click="Create_user()" class="btn btn-primary btn-icon-split">
    <span class="icon text-white-50">
      <i class="fa fa-user-plus"></i>
    </span>
    <span class="text">Add User</span>
  </button>
</template>

<script>
export default {
  props: ["directions_form"],
  methods: {
    Create_user() {
      this.$swal
        .mixin(this.$root.MixinContent(["1", "2", "3"]))
        .queue([
          {
            title: "Add user",
            text: "Type the name.",
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
            title: "Add user",
            text: "Type the email.",
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
            title: "Add user",
            text: "Select the department",
            input: "select",
            inputOptions: this.directions_form,
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
              name: result.value[0],
              email: result.value[1],
              department_id: result.value[2],
            });
          }
        });
    },
    Add(data) {
      this.$root.BasicLoading();
      axios.post("api/user", data).then(
        (response) => {
          this.$emit("creation");
          this.$root.SuccessMessage(
            "User " + response.data.name + " created!",
            "Default password: " + response.data.name
          );
        },
        (error) => {
          this.$root.ErrorMessage("", error);
        }
      );
    },
  },
};
</script>