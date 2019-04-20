import VueRouter from 'vue-router';

import AddAuthor from './components/Authors/AddAuthor';
import EditAuthor from './components/Authors/EditAuthor';
import IndexAuthors from './components/Authors/IndexAuthors';
import AddBook from './components/Books/AddBook';
import EditBook from './components/Books/EditBook';
import IndexBooks from './components/Books/IndexBooks';
import AddCategory from './components/Categories/AddCategory';
import EditCategory from './components/Categories/EditCategory';
import IndexCategories from './components/Categories/IndexCategories';
import AddDepartment from './components/Departments/AddDepartment';
import EditDepartment from './components/Departments/EditDepartment';
import IndexDepartments from './components/Departments/IndexDepartments';
import EditAccesslevel from './components/Accesslevels/EditAccesslevel';
import IndexAccesslevels from './components/Accesslevels/IndexAccesslevels';
import AddUser from './components/Users/AddUser';
import EditUser from './components/Users/EditUser';
import IndexUsers from './components/Users/IndexUsers';
import Profile from './components/Profile';
import Reports from './components/Reports';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/profile',
            name: 'profile',
            component: Profile,
            props: true
        },
        {
            path: '/weeklyreport',
            name: 'reports',
            component: Reports
        },
        {
            path: '/add-author',
            name: 'addAuthor',
            component: AddAuthor
        },
        {
            path: '/edit-author/:id',
            name: 'editAuthor',
            component: EditAuthor,
            props: true
        },
        {
            path: '/authors',
            name: 'indexAuthors',
            component: IndexAuthors
        },
        {
            path: '/add-book',
            name: 'addBook',
            component: AddBook
        },
        {
            path: '/edit-book/:id',
            name: 'editBook',
            component: EditBook,
            props: true
        },
        {
            path: '/books',
            name: 'indexBooks',
            component: IndexBooks
        },
        {
            path: '/add-category',
            name: 'addCategory',
            component: AddCategory
        },
        {
            path: '/edit-category/:id',
            name: 'editCategory',
            component: EditCategory,
            props: true
        },
        {
            path: '/categories',
            name: 'indexCategories',
            component: IndexCategories
        },
        {
            path: '/add-department',
            name: 'addDepartment',
            component: AddDepartment
        },
        {
            path: '/edit-department/:id',
            name: 'editDepartment',
            component: EditDepartment,
            props: true
        },
        {
            path: '/departments',
            name: 'indexDepartments',
            component: IndexDepartments
        },
        {
            path: '/edit-accesslevel',
            name: 'editAccesslevel',
            component: EditAccesslevel,
            props: true
        },
        {
            path: '/accesslevels',
            name: 'indexAccesslevels',
            component: IndexAccesslevels
        },
        {
            path: '/add-user',
            name: 'addUser',
            component: AddUser
        },
        {
            path: '/edit-user/:id',
            name: 'editUser',
            component: EditUser,
            props: true
        },
        {
            path: '/users',
            name: 'indexUsers',
            component: IndexUsers
        }
    ]
});
export default router;