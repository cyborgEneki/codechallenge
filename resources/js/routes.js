import VueRouter from 'vue-router';

import AddAuthor from './components/Authors/AddAuthor';
import DetailAuthor from './components/Authors/DetailAuthor';
import EditAuthor from './components/Authors/EditAuthor';
import IndexAuthors from './components/Authors/IndexAuthors';
import AddBook from './components/Books/AddBook';
import DetailBook from './components/Books/DetailBook';
import EditBook from './components/Books/EditBook';
import IndexBooks from './components/Books/IndexBooks';
import AddCategory from './components/Categories/AddCategory';
import DetailCategory from './components/Categories/DetailCategory';
import EditCategory from './components/Categories/EditCategory';
import IndexCategories from './components/Categories/IndexCategories';
import AddDepartment from './components/Departments/AddDepartment';
import DetailDepartment from './components/Departments/DetailCategory';
import EditDepartment from './components/Departments/EditDepartment';
import IndexDepartments from './components/Departments/IndexDepartments';
import AddUser from './components/Users/AddUser';
import DetailUser from './components/Users/DetailUser';
import EditUser from './components/Users/EditUser';
import IndexUsers from './components/Users/IndexUsers';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/add-author',
            name: 'addAuthor',
            component: AddAuthor
        },
        {
            path: '/detail-author',
            name: 'detailAuthor',
            component: DetailAuthor
        },
        {
            path: '/edit-author',
            name: 'editAuthor',
            component: EditAuthor
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
            path: '/detail-book',
            name: 'detailBook',
            component: DetailBook
        },
        {
            path: '/edit-book',
            name: 'editBook',
            component: EditBook
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
            path: '/detail-category',
            name: 'detailCategory',
            component: DetailCategory
        },
        {
            path: '/edit-category',
            name: 'editCategory',
            component: EditCategory
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
            path: '/detail-department',
            name: 'detailDepartment',
            component: DetailDepartment
        },
        {
            path: '/edit-department',
            name: 'editDepartment',
            component: EditDepartment
        },
        {
            path: '/departments',
            name: 'indexDepartments',
            component: IndexDepartments
        },
        {
            path: '/add-user',
            name: 'addUser',
            component: AddUser
        },
        {
            path: '/detail-user',
            name: 'detailUser',
            component: DetailUser
        },
        {
            path: '/edit-user',
            name: 'editUser',
            component: EditUser
        },
        {
            path: '/users',
            name: 'indexUsers',
            component: IndexUsers
        }
    ]
});
export default router;