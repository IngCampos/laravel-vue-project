  
<template>
  <form v-on:submit.prevent="Add()" style="text-align:justify" class="row">
    <div class="form-group col-12 col-lg-6 row">
      <label for="password" class="col-md-5 col-form-label">New password:</label>
      <input
        class="form-control col-md-7"
        type="password"
        name="password"
        v-model="password"
        required
        minlength="8"
        maxlength="30"
      />
    </div>
    <div class="form-group col-12 col-lg-6 row">
      <label for="password2" class="col-md-5 col-form-label">Repeat password:</label>
      <input
        class="form-control col-md-7"
        type="password"
        name="password2"
        v-model="password2"
        required
        minlength="8"
        maxlength="30"
      />
    </div>
    <center class="col-12">
      <input type="submit" value="Update" class="btn btn-success" />
    </center>
  </form>
</template>

<script>
export default {
  methods: {
    Add() {
      if (this.password == "") {
        this.$root.InfoMessage("The field cannot be empty!");
        return;
      } else if (this.$root.Strong_password(this.password)) {
        this.$root.InfoMessage(
          "Weak password!!!",
          "It must contain 8 characters, lowercase, uppercase, numbers and special characters."
        );
        return;
      } else if (this.password != this.password2) {
        this.$root.InfoMessage("The password do not match!");
        return;
      }
      this.$root.BasicLoading();
      axios
        .post("api/update_password", {
          password: this.password,
          password2: this.password2,
        })
        .then(
          (response) => {
            this.Clean();
            this.$root.SuccessMessage("Password updated!");
          },
          (error) => {
            this.$root.ErrorMessage("", error);
          }
        );
    },
    Clean() {
      this.password = "";
      this.password2 = "";
    },
  },
  data() {
    return {
      password: "",
      password2: "",
    };
  },
};
</script>