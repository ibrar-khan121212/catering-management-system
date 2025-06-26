import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="Welcome">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>

            <div className="min-h-screen flex flex-col items-center justify-between bg-gradient-to-br from-white to-gray-100 dark:from-black dark:to-gray-900 p-6">
                {/* Header */}
                <header className="w-full flex justify-between items-center max-w-7xl">
                    <h2 className="text-xl font-semibold text-gray-800 dark:text-white">Catering Management</h2>
                    <nav className="space-x-4 flex items-center">
                        {auth.user ? (
                            <>
                                {auth.user.is_admin ? (
                                    <Link
                                        href={route('dashboard')}
                                        className="px-4 py-2 text-sm rounded bg-blue-600 text-white hover:bg-blue-700 transition"
                                        hidden={!auth.user.is_admin}
                                        disabled={!auth.user.is_admin}
                                    >
                                        Admin Dashboard
                                    </Link>
                                ) : (
                                    <Link
                                        href={route('dashboard')}
                                        className="px-4 py-2 text-sm rounded bg-blue-600 text-white hover:bg-blue-700 transition"
                                        hidden={!auth.user.is_admin}
                                        disabled={!auth.user.is_admin}
                                   >
                                        My Dashboard
                                    </Link>
                                )}

                                {/* Logout button */}
                                <Link
                                    href={route('logout')}
                                    method="post"
                                    as="button"
                                    className="px-4 py-2 text-sm rounded bg-red-600 text-white hover:bg-red-700 transition"
                                >
                                    Logout
                                </Link>
                            </>
                        ) : (
                            <>
                                <Link
                                    href={route('login')}
                                    className="px-4 py-2 text-sm rounded border border-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800"
                                >
                                    Log in
                                </Link>
                                <Link
                                    href={route('register')}
                                    className="px-4 py-2 text-sm rounded border border-gray-300 hover:bg-gray-200 dark:hover:bg-gray-800"
                                >
                                    Register
                                </Link>
                            </>
                        )}
                    </nav>
                </header>

                {/* Main Section */}
                <main className="text-center flex flex-col items-center justify-center flex-1 px-4">
                    <h1 className="text-5xl font-extrabold text-gray-900 dark:text-white mb-6">
                        Welcome to Our Catering Service
                    </h1>
                    <p className="text-lg text-gray-600 dark:text-gray-300 mb-8 max-w-2xl">
                        We provide top-notch catering and event management to make your moments unforgettable.
                    </p>
                    {/* <Link
                        href={route('orders.create')}
                        className="px-8 py-3 bg-green-600 text-white rounded-lg text-lg hover:bg-green-700 transition"
                    >
                        Place Your Order
                    </Link> */}
                    <Link
                        href={route('client.orders.create')}
                        className="px-8 py-3 bg-green-600 text-white rounded-lg text-lg hover:bg-green-700 transition"
                    >
                        Place Your Order
                    </Link>


                </main>

                {/* Footer */}
                <footer className="mt-10 text-sm text-gray-500 dark:text-gray-400">
                    &copy; {new Date().getFullYear()} Catering Management System. All rights reserved.
                </footer>
            </div>
        </>
    );
}
