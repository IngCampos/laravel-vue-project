  
<template>
  <table-container>
    <template v-slot:head>
      <th class="col-name-long">User Agent <i class="fas fa-sort-alpha-down"/></th>
      <th>State</th>
      <th class="col-date">Updated at</th>
      <th class="col-action-2">Actions</th>
    </template>
    <template v-slot:body>
      <machine-row
        v-for="(machine, index) in machines"
        :key="machine.id"
        :machine="machine"
        @update="Update(index, machine.id, ...arguments)"
      ></machine-row>
    </template>
    <template v-slot:footer>
      <pagination
       :pagination="pagination" 
       :offset="offset"
       @changePage="getMachines(...arguments)"/>
    </template>
  </table-container>
</template>

<script>
export default {
  methods: {
    getMachines(page) {
      axios.get("api/machine_state?page=" + page).then((response) => {
        this.machines = response.data.machines;
        this.pagination = response.data.pagination;
      });
    },
    Update(index, id, newstate) {
      this.$swal
        .fire(
          this.$root.ConfirmMessageValue(
            "Are you sure to update " +
              this.machines[index].user_agent +
              " to " +
              (newstate == 1
                ? "active"
                : newstate == 2
                ? "in maintenance"
                : "no active") +
              "?"
          )
        )
        .then((result) => {
          if (result.value) {
            this.$root.BasicLoading();
            axios
              .put(`api/machine_state/${id}`, {
                machine_state_id: newstate,
              })
              .then(
                (response) => {
                  this.machines[index] = response.data;
                  this.$forceUpdate();
                  this.$root.SuccessMessage(
                    "Machine " + response.data.user_agent + " updated!"
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
  created() {
    this.getMachines(1);
  },
  data() {
    return {
      machines: [],
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0,
      },
      offset: 4
    };
  },
};
</script>