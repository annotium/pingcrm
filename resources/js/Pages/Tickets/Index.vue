<template>
  <div>
    <Head title="Tickets" />
    <h1 class="mb-8 text-3xl font-bold">Tickets</h1>
    <div class="flex items-center justify-between mb-6">
      <search-filter v-model="form.search" class="w-full max-w-md mr-4" @reset="reset">
      </search-filter>
      <Link class="btn-indigo" href="/tickets/refresh">
        <span>Refresh</span>
        <span class="hidden md:inline">&nbsp;Tickets</span>
      </Link>
    </div>
    <div class="overflow-x-auto bg-white rounded-md shadow">
      <table class="w-full whitespace-nowrap">
        <thead>
          <tr class="font-bold text-left">
            <th class="px-6 pt-6 pb-4">Name</th>
            <th class="px-6 pt-6 pb-4">Bid</th>
            <th class="px-6 pt-6 pb-4" colspan="2">Ask</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="ticket in tickets.data" :key="ticket.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
            <td class="border-t">
              <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/tickets/${ticket.id}/edit`">
                {{ ticket.name }}
                <icon v-if="ticket.deleted_at" name="trash" class="w-3 h-3 ml-2 shrink-0 fill-gray-400" />
              </Link>
            </td>
            <!-- <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="`/organizations/${organization.id}/edit`" tabindex="-1">
                {{ organization.city }}
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="`/organizations/${organization.id}/edit`" tabindex="-1">
                {{ organization.phone }}
              </Link>
            </td>
            <td class="w-px border-t">
              <Link class="flex items-center px-4" :href="`/organizations/${organization.id}/edit`" tabindex="-1">
                <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
              </Link>
            </td> -->
          </tr>
          <!-- <tr v-if="tickets.length === 0">
            <td class="px-6 py-4 border-t" colspan="4">No tickets found.</td>
          </tr> -->
        </tbody>
      </table>
    </div>
    <!-- <pagination class="mt-6" :links="tickets.links" /> -->
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3'
import Icon from '@/Shared/Icon.vue'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout.vue'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination.vue'
import SearchFilter from '@/Shared/SearchFilter.vue'

export default {
  components: {
    Head,
    Icon,
    Link,
    Pagination,
    SearchFilter,
  },
  layout: Layout,
  props: {
    time: Object,
    tickets: Object,
  },
  data() {
    return {
      form: {
        // search: this.filters.search,
      },
    }
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get('/tickets', pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
  },
}
</script>
