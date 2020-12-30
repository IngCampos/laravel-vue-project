  
<template>
<!-- TODO: create the table as other component and use the slots-->
  <div style="overflow-x:auto;">
    <table style="width:100%" class="table table-striped">
      <thead>
        <tr>
          <th style="min-width:195px">
            User Agent
            <i class="fas fa-sort-alpha-down"></i>
          </th>
          <th class="text-center">State</th>
          <th style="min-width:145px" class="text-center">Updated at</th>
          <th style="min-width:115px" class="text-right">Actions</th>
        </tr>
      </thead>
      <tbody>
        <machine-row
          v-for="(machine, index) in machines"
          :key="machine.id"
          :machine="machine"
          @update="Update(index, machine.id, ...arguments)"
        ></machine-row>
        <!-- TODO: Create a special component for the pagination -->
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  methods: {
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
    axios.get("api/machine_state").then((response) => {
      this.machines = response.data;
    });
  },
  data() {
    return {
      machines: [],
    };
  },
};
</script>