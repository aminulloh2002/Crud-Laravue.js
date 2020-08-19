// import file yang dibuat tadi
// import Create from './components/Create.vue';
import Read from './components/Read';
// import Update from './components/Update.vue';
// import Read2 from './components/Read2.vue';

// membuat router
export const routes = [
    {
        name: 'read',
        path: '/',
        component: Read
    },
    // {
    //     name: 'create',
    //     path: '/create',
    //     component: Create
    // },
    // {
    //     name: 'update',
    //     path: '/detail/:id',
    //     component: Update
    // }
    // ,
    // {
    //     name: 'read2',
    //     path: '/read2',
    //     component: Read2
    // }
]
