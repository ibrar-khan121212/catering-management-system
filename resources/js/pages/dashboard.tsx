import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

const cards = [
    { href: '/customers', color: 'from-blue-400 to-blue-600', label: 'Customers', desc: 'Manage client profiles', icon: '👥' },
    { href: '/events', color: 'from-green-400 to-green-600', label: 'Events', desc: 'Plan & schedule events', icon: '📅' },
    { href: '/orders', color: 'from-yellow-400 to-orange-500', label: 'Orders', desc: 'Track order status', icon: '📦' },
    { href: '/payments', color: 'from-emerald-400 to-emerald-600', label: 'Payments', desc: 'Manage payments', icon: '💰' },
    { href: '/menu_items', color: 'from-purple-400 to-purple-600', label: 'Menu Items', desc: 'Manage your menu', icon: '🍽️' },
    { href: '/inventory_items', color: 'from-indigo-400 to-indigo-600', label: 'Inventory', desc: 'Stock control', icon: '📦' },
    { href: '/employees', color: 'from-teal-400 to-teal-600', label: 'Employees', desc: 'Manage staff', icon: '🧑‍💼' },
    { href: '/chefs', color: 'from-red-400 to-red-600', label: 'Chefs', desc: 'Kitchen management', icon: '👨‍🍳' },
    { href: '/servers', color: 'from-cyan-400 to-cyan-600', label: 'Servers', desc: 'Service team', icon: '🧑‍🍽️' },
    { href: '/event_managers', color: 'from-amber-400 to-amber-600', label: 'Event Managers', desc: 'Coordination staff', icon: '🎤' },
    { href: '/order_menuitem', color: 'from-pink-400 to-pink-600', label: 'Order Items', desc: 'Menu-order link', icon: '🔗' },
    { href: '/menuitem_inventoryitem', color: 'from-rose-400 to-rose-600', label: 'Recipes', desc: 'Menu-stock relations', icon: '📋' },
    { href: '/employee_events', color: 'from-violet-400 to-violet-600', label: 'Staff Events', desc: 'Assignments & shifts', icon: '📊' },
];

export default function Dashboard() {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            
            <div className="min-h-screen gradient-bg text-black dark:text-white relative overflow-hidden bg-white dark:bg-gray-900">
                <div className="absolute top-[-100px] left-[-100px] w-[300px] h-[300px] rounded-full bg-white opacity-5 blur-3xl dark:bg-gray-700"></div>
                <div className="absolute bottom-[-100px] right-[-100px] w-[300px] h-[300px] rounded-full bg-white opacity-5 blur-3xl dark:bg-gray-700"></div>

                <div className="text-center py-16 px-4 max-w-4xl mx-auto">
                    <h1 className="text-5xl md:text-6xl font-extrabold text-black dark:text-white leading-tight mb-4 fade-in-up">
                        Catering <span className="text-yellow-300">Management</span>
                    </h1>
                    <p className="text-xl text-gray-600 dark:text-gray-300 max-w-xl mx-auto fade-in-up">
                        Streamline your catering business operations with ease and elegance.
                    </p>
                </div>

                <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-4 pb-20 max-w-7xl mx-auto">
                    {cards.map((card, index) => (
                        <Link key={index} href={card.href} className="glass rounded-xl p-5 text-center shadow-lg hover:scale-105 transform transition bg-white/10 dark:bg-gray-700">
                            <div className={`w-14 h-14 mx-auto flex items-center justify-center bg-gradient-to-br ${card.color} rounded-full text-2xl`}>
                                {card.icon}
                            </div>
                            <h2 className="mt-4 font-bold text-lg text-black dark:text-white">{card.label}</h2>
                            <p className="text-sm text-gray-600 dark:text-gray-300">{card.desc}</p>
                        </Link>
                    ))}
                </div>

                <div className="bg-white/5 dark:bg-gray-800 py-10 px-4 mt-8">
                    <div className="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                        <div className="glass p-6 rounded-xl bg-white/10 dark:bg-gray-700">
                            <div className="text-3xl font-bold text-black dark:text-white">250+</div>
                            <div className="text-gray-700 dark:text-gray-300 text-sm">Active Customers</div>
                        </div>
                        <div className="glass p-6 rounded-xl bg-white/10 dark:bg-gray-700">
                            <div className="text-3xl font-bold text-black dark:text-white">89</div>
                            <div className="text-gray-700 dark:text-gray-300 text-sm">Events This Month</div>
                        </div>
                        <div className="glass p-6 rounded-xl bg-white/10 dark:bg-gray-700">
                            <div className="text-3xl font-bold text-black dark:text-white">45</div>
                            <div className="text-gray-700 dark:text-gray-300 text-sm">Team Members</div>
                        </div>
                        <div className="glass p-6 rounded-xl bg-white/10 dark:bg-gray-700">
                            <div className="text-3xl font-bold text-black dark:text-white">98%</div>
                            <div className="text-gray-700 dark:text-gray-300 text-sm">Order Success Rate</div>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}