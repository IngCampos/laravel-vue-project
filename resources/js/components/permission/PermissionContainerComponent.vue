  
<template>
  <tbody>
    <tr class="section-row">
      <td colspan="2" class="text-center">
        <span class="badge section-badge">{{permission.info.name}}</span>
      </td>
      <td class="col-action-2">
        <button 
        v-on:click="$root.InfoMessage('Permiso: '+permission.info.name, permission.info.description)"
        class="btn btn-secondary btn-circle">
          <i class="fas fa-info-circle"></i>
        </button>
      </td>
    </tr>
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