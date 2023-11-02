<template>
  <div
    class="bg-white dark:bg-gray-800 flex items-start py-4 px-4 space-x-4"
    :dusk="`notification-${notification.id}`"
  >
    <div class="flex-shrink-0">
      <Icon :type="icon" :class="notification.iconClass" />
    </div>

    <div class="flex-auto space-y-4">
      <div>
        <div class="flex items-center">
          <div class="flex-auto">
            <p
              class="mr-1 text-gray-600 dark:text-gray-400 leading-normal break-words"
            >
              {{ notification.message }}
            </p>
          </div>
        </div>

        <p class="mt-1 text-xs" :title="notification.created_at">
          {{ notification.created_at_friendly }}
        </p>
      </div>

      <DefaultButton v-if="hasUrl" @click="handleClick" size="xs">
        {{ notification.actionText }}
      </DefaultButton>

      <div class="flex items-center space-x-3">
        <button
          type="button"
          @click.stop="handleDeleteClick"
          dusk="delete-button"
          class="group text-gray-500 text-xs font-bold inline-flex items-center justify-center focus:outline-none focus:ring ring-primary-200 dark:ring-gray-600 rounded space-x-1"
        >
          <Icon
            type="trash"
            :solid="true"
            class="text-gray-300 dark:text-gray-500 group-hover:text-gray-400 dark:group-hover:text-gray-400"
          />
          <span
            class="group-hover:text-gray-600 dark:group-hover:text-gray-400"
            >{{ __('Delete') }}</span
          >
        </button>

        <button
          type="button"
          @click.stop="$emit('mark-as-read')"
          dusk="mark-as-read-button"
          class="group text-gray-500 text-xs font-bold inline-flex items-center justify-center focus:outline-none focus:ring ring-primary-200 dark:ring-gray-600 rounded space-x-1"
        >
          <Icon
            type="eye"
            :solid="true"
            class="text-gray-300 dark:text-gray-500 group-hover:text-gray-400 dark:group-hover:text-gray-400"
          />
          <span
            class="group-hover:text-gray-600 dark:group-hover:text-gray-400"
            >{{ __('Mark Read') }}</span
          >
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { mapMutations } from 'vuex'

export default {
  name: 'MessageNotification',

  props: {
    notification: {
      type: Object,
      required: true,
    },
  },

  methods: {
    ...mapMutations(['toggleNotifications']),

    handleClick() {
      this.toggleNotifications()
      this.visit()
      this.$emit('hide')
    },

    handleDeleteClick() {
      if (
        confirm(this.__('Are you sure you want to delete this notification?'))
      ) {
        this.$emit('delete-notification')
      }
    },

    visit() {
      if (this.hasUrl) {
        return Nova.visit(this.notification.actionUrl, {
          openInNewTab: this.notification.openInNewTab || false,
        })
      }
    },
  },

  computed: {
    icon() {
      return this.notification.icon
    },

    hasUrl() {
      return this.notification.actionUrl
    },
  },
}
</script>
