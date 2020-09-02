  
<template>
  <button v-on:click="Create_permission()" class="btn btn-primary btn-icon-split">
    <span class="icon text-white-50">
      <i class="fa fa-key"></i>
    </span>
    <span class="text">Add permission</span>
  </button>
</template>

<script>
export default {
  methods: {
    Create_permission() {
      this.$swal
        .mixin(this.$root.MixinContent(["1", "2"]))
        .queue([
          {
            title: "Add permission.",
            input: "select",
            inputOptions: this.permissions_form,
            inputPlaceholder: "Select the permission",
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
          {
            title: "Add permission.",
            input: "select",
            inputOptions: this.users_form,
            inputPlaceholder: "Select the user",
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
            this.Add(
              {
                user_id: result.value[1].split(" ")[
                  result.value[1].split(" ").length - 1
                ],
                permission_id: this.permissions[result.value[0]].id,
              },
              result.value[0],
              this.users_form[result.value[1]]
            );
          }
        });
    },
    Add(data, permission, name) {
      this.$swal
        .fire(
          this.$root.ConfirmMessageValue(
            "Are you sure to add the following permission to " + name + "?",
            this.permissions[permission].name +
              ": " +
              this.permissions[permission].description,
            "A badly managed permission could have serious consequences."
          )
        )
        .then((result) => {
          if (result.value) {
            this.$root.BasicLoading();
            axios.post("api/permission", data).then(
              (response) => {
                this.$emit("creation", response.data, permission);
                this.$root.SuccessMessage("Permission added!");
              },
              (error) => {
                this.$root.ErrorMessage("", error);
              }
            );
          }
        });
    },
  },
  created: function () {
    axios.get("api/data_user").then((response) => {
      this.users_form = response.data;
    });
    axios.get("api/permission").then((response) => {
      this.permissions = response.data;
      for (let index = 0; index < this.permissions.length; index++) {
        this.permissions_form[index] = this.permissions[index].name;
      }
    });
  },
  data() {
    return {
      permissions: [],
      users_form: [],
      permissions_form: [],
    };
  },
};
</script>