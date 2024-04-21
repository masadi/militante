export default [
  {
    path: '/rekapitulasi-ptk',
    name: 'rekapitulasi-guru',
    component: () => import('@/views/rekapitulasi/guru/Index.vue'),
    meta: {
      resource: 'Rekapitulasi',
      action: 'read',
      pageTitle: 'Rekapitulasi PTK',
      breadcrumb: [
        {
          text: 'Rekapitulasi PTK',
          active: true,
        },
      ],
      tombol_add: {
        action: 'cetak-rekap-guru',
        link: '',
        variant: 'primary',
        text: 'Cetak Rekapitulasi'
      },
    },
  },
  {
    path: '/rekapitulasi-pd',
    name: 'rekapitulasi-pd',
    component: () => import('@/views/rekapitulasi/pd/Index.vue'),
    meta: {
      resource: 'Rekapitulasi',
      action: 'read',
      pageTitle: 'Rekapitulasi PD',
      breadcrumb: [
        {
          text: 'Rekapitulasi PD',
          active: true,
        },
      ],
      tombol_add: {
        action: 'cetak-rekap-pd',
        link: '',
        variant: 'primary',
        text: 'Cetak Rekapitulasi'
      },
    },
  },
  {
    path: '/rekapitulasi-kehadiran',
    name: 'rekapitulasi-kehadiran',
    component: () => import('@/views/pages/Blank.vue'),
    meta: {
      resource: 'Ptk_Pd',
      action: 'read',
      pageTitle: 'Rekapitulasi Kehadiran',
      breadcrumb: [
        {
          text: 'Rekapitulasi Kehadiran',
          active: true,
        },
      ],
    },
  },
  {
    path: '/rekapitulasi-ketidakhadiran',
    name: 'rekapitulasi-ketidakhadiran',
    component: () => import('@/views/pages/Blank.vue'),
    meta: {
      resource: 'Ptk_Pd',
      action: 'read',
      pageTitle: 'Rekapitulasi Ketidakhadiran',
      breadcrumb: [
        {
          text: 'Rekapitulasi Ketidakhadiran',
          active: true,
        },
      ],
    },
  },
]
