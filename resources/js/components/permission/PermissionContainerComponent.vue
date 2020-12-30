  
<template>
  <tbody>
    <td colspan="4" class="table-active">
      <center>
        <strong>{{permission.info.name}}</strong>
        <button
          v-on:click="$root.InfoMessage('Permiso: '+permission.info.name, permission.info.description)"
          class="btn btn-info badge"
        >
          <i class="fas fa-info-circle"></i> Info
        </button>
      </center>
    </td>
    <permission-row
      v-for="(user, index) in permission.users"
      :key="user.id"
      @delete="Delete(index)"
      :user="user"
    ></permission-row>
  </tbody>
</template>

<script>
export default {
  props: ["permission"],
  methods: {
    Delete(index) {
      this.$swal
        .fire(
          this.$root.ConfirmMessageValue(
            "¿Are you sure to delete the permission " +
              this.permission.info.name +
              " to " +
              this.permission.users[index].name +
              "?",
            ""
          )
        )
        .then((result) => {
          if (result.value) {
            this.$root.BasicLoading();
            axios
              .delete(
                `api/permission/${[
                  this.permission.users[index].pivot.permission_id,
                  this.permission.users[index].id,
                ]}`
              )
              .then(
                (response) => {
                  this.permission.users.splice(index, 1);
                  this.$root.SuccessMessage("Permission deleted!");
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