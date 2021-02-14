<template>
  <table-container>
    <template v-slot:head>
      <th>Id</th>
      <th>Image</th>
      <th>Link</th>
      <th>Expiration <i class="fas fa-sort-numeric-down"/></th>
      <th class="col-action-2">Actions</th>
    </template>
    <template v-slot:body>
      <advertisement-row
        v-for="(add, index) in adds"
        :key="add.id"
        :add="add"
        @delete="Delete(index, ...arguments)"
        @update="Update(index, ...arguments)"
      ></advertisement-row>
    </template>
    <template v-slot:footer>
      <advertisement-create @create="Create(...arguments)"></advertisement-create>
    </template>
  </table-container>
</template>

<script>
export default {
  props: ["data"],
  methods: {
    Create(new_add) {
      this.adds.push(new_add);
    },
    Delete(index, id) {
      this.$swal
        .fire(
          this.$root.ConfirmMessageValue(
            "¿Are you sure to delete the add id " +
              this.adds[index].id +
              "?",
            "The image in the server is also deleted."
          )
        )
        .then((result) => {
          if (result.value) {
            this.$root.BasicLoading();
            axios.delete(`api/advertisement/${id}`).then(
              (response) => {
                this.adds[this.adds[index].id - 1] = {
                  id: this.adds[index].id,
                };
                this.$root.SuccessMessage("add deleted!");
                this.$forceUpdate();
              },
              (error) => {
                this.$root.ErrorMessage("", error);
              }
            );
          }
        });
    },
    Update(index, data) {
      this.adds[index] = data;
      this.$forceUpdate();
    },
  },
  created() {
    this.adds = JSON.parse(this.data);
  },
  data() {
    return {
      adds: [],
    };
  },
};
</script>
