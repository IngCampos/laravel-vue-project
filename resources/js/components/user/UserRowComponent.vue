  
<template>
  <tr>
    <td>
      <i v-if="user.isEnabled" class="fas fa-user-check text-success"></i>
      <i v-else class="fas fa-user-times text-danger"></i>
      {{user.name}}
    </td>
    <td>{{user.email}}</td>
    <td class="text-center">
      <span :class="'badge badge-'+$root.colors[user.department.id-1]">{{user.department.name}}</span>
    </td>
    <td class="dropdown no-arrow">
      <a
        class="dropdown-toggle"
        href="#"
        role="button"
        id="dropdownMenuLink"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
      >
        <i class="fas fa-ellipsis-v fa-sm fa-fw rounded-circle float-right"></i>
      </a>
      <div
        class="dropdown-menu dropdown-menu-right animated--fade-in"
        aria-labelledby="dropdownMenuLink"
      >
        <div class="dropdown-header">Options:</div>
        <a v-on:click="Change_data()" class="btn btn-primary dropdown-item">
          <i class="fas fa-user-edit text-primary"></i> Edit
        </a>
        <a v-on:click="Change_password()" class="btn btn-warning dropdown-item">
          <i class="fa fa-key text-secondary"></i> Change password
        </a>
        <a v-on:click="Enable()" class="btn dropdown-item">
          <i v-if="!user.isEnabled" class="fas fa-user-check text-success"></i>
          <i v-else class="fas fa-user-times text-warning"></i>
          <span v-if="!user.isEnabled">Enable</span>
          <span v-else>Disable</span>
        </a>
        <a v-on:click="Delete()" class="btn btn-warning dropdown-item">
          <i class="fas fa-user-slash text-danger"></i> Delete
        </a>
        <div class="dropdown-divider"></div>
        <a class="btn btn-info dropdown-item" v-on:click="Show_info()">More information</a>
      </div>
    </td>
  </tr>
</template>

<script>
export default {
  props: ["user", "department_form"],
  methods: {
    Show_info() {
      const date = this.$options.filters.date;
      this.$root.InfoMessage(
        "Usuario " + this.user.namelogin + ".",
        "<strong>Name</strong>: " +
          this.user.name +
          "<br><strong>Email</strong>: " +
          this.user.email +
          "<br><strong>Department</strong>: " +
          this.user.department.name +
          "<br><strong>Created at</strong>: " +
          date(this.user.created_at) +
          "<br><strong>Updated at</strong>: " +
          date(this.user.updated_at)
      );
    },
    Change_data() {
      var options = "";
      // html code for the option inputs
      for (var department in this.department_form) {
        options += "<option value='" + department + "'";
        // if the department is the current, it is selected
        if (department == this.user.department_id) options += " selected";
        options += ">" + this.department_form[department] + "</option>";
      }
      this.$swal.fire({
        title: "Edit user " + this.user.name,
        html:
          'Name<input id="name" class="swal2-input" value="' +
          this.user.name +
          '" required>' +
          'Email:<input id="email" class="swal2-input" value="' +
          this.user.email +
          '" required>' +
          "Department:<select class='swal2-input' id='department_id'>" +
          options +
          "</select>",
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: "Save",
        preConfirm: () => {
          this.Edit({
            name: document.getElementById("name").value,
            email: document.getElementById("email").value,
            department_id: document.getElementById("department_id").value,
          });
        },
      });
    },
    Change_password() {
      this.$swal
        .mixin(this.$root.MixinContent(["1", "2"]))
        .queue([
          {
            title: "Change password of " + this.user.name,
            text: "Type the new password",
            input: "password",
            inputValidator: (value) => {
              return new Promise((resolve) => {
                if (value == "") {
                  resolve("The field cannot be empty.");
                } else if (this.$root.Strong_password(value)) {
                  resolve("Weak password!!");
                } else {
                  resolve();
                }
              });
            },
          },
          {
            title: "Change password of " + this.user.name,
            text: "Type again the password.",
            input: "password",
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
        ])
        .then((result) => {
          if (result.value) {
            if (result.value[0] == result.value[1])
              this.Edit({
                password: result.value[0],
              });
            else
              this.$root.ErrorMessage("Passwords do not match!!", "Try again");
          }
        });
    },
    Edit(data) {
      this.$root.BasicLoading();
      axios.put(`api/user/${this.user.id}`, data).then(
        (response) => {
          // the data is filtered by the name login
          // then the main component needs to do specific function if the filter value is changed
          if (this.user.name != response.data.name) this.$emit("update");
          // if the name was updated, the function that get the users runs
          else this.$emit("justupdate", response.data);
          // if not, the main component just updates this element with the new data

          this.$root.SuccessMessage("User " + response.data.name + " updated!");
        },
        (error) => {
          this.$root.ErrorMessage("", error);
        }
      );
    },
    Enable() {
      this.$swal
        .fire(
          this.$root.ConfirmMessageValue(
            "Are you sure to " +
              (this.user.isEnabled ? "disable " : "enable ") +
              this.user.name +
              "?",
            "The user will "+(this.user.isEnabled ? "not" : "") +" be able to use the system."
          )
        )
        .then((result) => {
          if (result.value) {
            this.$root.BasicLoading();
            axios.delete(`api/user/${this.user.id}/disable`).then(
              (response) => {
                this.$emit("enable");
                this.$forceUpdate();
                this.$root.SuccessMessage(
                  "User " + (this.user.isEnable ? "enabled" : "disabled")
                );
              },
              (error) => {
                this.$root.ErrorMessage("", error);
              }
            );
          }
        });
    },
    Delete() {
      this.$swal
        .fire(
          this.$root.ConfirmMessageValue(
            "Are you sure to delete " +
              this.user.name +
              "?",
            "The user is saved yet in the database but he is not going to appear in the system."
          )
        )
        .then((result) => {
          if (result.value) {
            this.$root.BasicLoading();
            axios.delete(`api/user/${this.user.id}`).then(
              (response) => {
                this.$emit("delete");
                this.$forceUpdate();
                this.$root.SuccessMessage(
                  "User deleted!"
                );
              },
              (error) => {
                this.$root.ErrorMessage("", error);
              }
            );
          }
        });
    },
  },
};
</script>