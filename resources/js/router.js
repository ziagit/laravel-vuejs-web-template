import Vue from 'vue';
import VueRouter from 'vue-router';
import Admin from './components/admin/Admin';
import PostsAdmin from './components/admin/posts/PostsAdmin';
import Dashboard from './components/admin/dashboard/Dashboard';
import ProjectsAdmin from './components/admin/projects/ProjectsAdmin';
import TechsAdmin from './components/admin/techs/TechsAdmin';
import InfoAdmin from './components/admin/techs/techinfo/InfoAdmin';
import CompanyAdmin from './components/admin/company/CompanyAdmin';
import TeamAdmin from './components/admin/team/TeamAdmin';
import ContactAdmin from './components/admin/contact/ContactAdmin';

import Web from './components/web/Web';
import Home from './components/web/home/Home';
import Content from './components/web/Content';
import Projects from './components/web/projects/Projects';
import Project from './components/web/projects/Project';
import Posts from './components/web/posts/Posts';
import Post from './components/web/posts/Post';
import About from './components/web/About';
import Contact from './components/web/Contact';
import NotFound from './components/web/NotFound';


Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {
            path: '/',
            component: Web,
            children: [
                { path: '', component: Home },
                { path: '/about', component: About },
                { path: '/contact', component: Contact },
                {
                    path: '/content', component: Content,
                    children: [
                        { path: '', redirect: '/posts'},
                        { path: '/posts', component: Posts },
                        { path: '/posts/:postId/:name', component: Post, props: true },
                        { path: '/projects/:projectId/:name', component: Project, props: true }
                    ]
                },
                {path: 'not-found', component: NotFound}
            ]
        },
        {
            path: '/admin',
            component: Admin,
            children: [
                { path: '', component: Dashboard },
                { path: 'posts', component: PostsAdmin },
                { path: 'projects', component: ProjectsAdmin },
                { path: 'techs', component: TechsAdmin },
                { path: 'techs-info', component: InfoAdmin },
                { path: 'company', component: CompanyAdmin },
                { path: 'team', component: TeamAdmin },
                { path: 'contact', component: ContactAdmin },
            ]
        },
        {path: '*', redirect: '/'}
    ],
    mode: 'history'
})