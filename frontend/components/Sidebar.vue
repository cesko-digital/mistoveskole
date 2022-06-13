<template>
  <div class="sidebar">
    <div class="!hidden collapse">
      <svg
        width="8"
        height="14"
        viewBox="0 0 8 14"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M7 13L1 7L7 1"
          stroke="#262729"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
      </svg>
    </div>

    <div class="search">
      <InfoText />

      <SchoolSelect class="hidden md:flex" />
    </div>

    <FindAppropriateSchool />

    <div class="info">
      <a href="/how-the-czech-education-system-works" class="info-item">
        <div class="info-item-icon">
          <svg
            width="40"
            height="40"
            viewBox="0 0 40 40"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <rect width="40" height="40" rx="20" fill="#FFE70D" />
            <path
              d="M20 15C20 13.9391 19.5786 12.9217 18.8284 12.1716C18.0783 11.4214 17.0609 11 16 11H10V26H17C17.7956 26 18.5587 26.3161 19.1213 26.8787C19.6839 27.4413 20 28.2044 20 29M20 15V29M20 15C20 13.9391 20.4214 12.9217 21.1716 12.1716C21.9217 11.4214 22.9391 11 24 11H30V26H23C22.2044 26 21.4413 26.3161 20.8787 26.8787C20.3161 27.4413 20 28.2044 20 29"
              stroke="#0D99FF"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </div>

        <div class="info-item-text">
          {{ $t('components.Sidebar.how_the_Czech_education_system_works') }}
        </div>

        <div class="info-item-arrow">
          <svg
            width="8"
            height="14"
            viewBox="0 0 8 14"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M1 13L7 7L1 1"
              stroke="#262729"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </div>
      </a>

      <a href="/how-to-enroll-a-child-in-school" class="info-item">
        <div class="info-item-icon">
          <svg
            width="40"
            height="40"
            viewBox="0 0 40 40"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <rect width="40" height="40" rx="20" fill="#FFE70D" />
            <path
              d="M10 10L24.5 13.5L26 21L21 26L13.5 24.5L10 10ZM10 10L17.586 17.586M20 27L27 20L30 23L23 30L20 27ZM21 19C21 20.1046 20.1046 21 19 21C17.8954 21 17 20.1046 17 19C17 17.8954 17.8954 17 19 17C20.1046 17 21 17.8954 21 19Z"
              stroke="#0D99FF"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </div>

        <div class="info-item-text">
          {{ $t('components.Sidebar.how_to_enroll_a_child_in_school') }}
        </div>

        <div class="info-item-arrow">
          <svg
            width="8"
            height="14"
            viewBox="0 0 8 14"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M1 13L7 7L1 1"
              stroke="#262729"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </div>
      </a>

      <div>
        <Button :inline="true">
          <span>
            {{ $t('components.Sidebar.more_information') }}
          </span>

          <svg
            width="16"
            height="16"
            viewBox="0 0 16 16"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M1 8H15M15 8L8 1M15 8L8 15"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </Button>
      </div>
    </div>

    <div class="grow">
      &nbsp;
    </div>

    <StandWithUkraine class=" rounded-t-outer" />
  </div>
</template>

<style scoped>
.sidebar {
  @apply flex flex-col flex-grow h-full;
}

.collapse {
  @apply lg:flex hidden flex-row py-xss px-l place-content-end;
}

.search {
 @apply hidden md:flex flex-col gap-l p-l;
}

/* Pages for these links are not implemented yet */
.info {
  @apply flex flex-col p-l space-y-m;
  display: none;
}
.info-item {
  @apply flex flex-row space-x-s items-center;
}
.info-item-text {
  @apply flex-grow text-body-bold leading-body-bold font-body-bold tracking-body-bold;
}
</style>
