import React from 'react';
import { Head, Link, useForm } from '@inertiajs/react';

type MenuItem = {
  MenuItem_ID: number;
  Name: string;
  Price: number;
  Description: string;
};

type MenuItemSelection = {
  id: number | '';
  qty: number;
};

type OrderForm = {
  customer_name: string;
  customer_email: string;
  customer_contact: string;
  event_type: string;
  event_date: string;
  event_location: string;
  menu_items: MenuItemSelection[];
};

interface OrderCreateProps {
  menuItems: MenuItem[];
}

export default function OrderCreate({ menuItems }: OrderCreateProps) {
  const { data, setData, post, processing, errors, reset } = useForm<OrderForm>({
    customer_name: '',
    customer_email: '',
    customer_contact: '',
    event_type: '',
    event_date: '',
    event_location: '',
    menu_items: [],
  });

  const addMenuItem = () => {
    setData('menu_items', [...data.menu_items, { id: '', qty: 1 }]);
  };

  const updateMenuItem = (
    index: number,
    field: keyof MenuItemSelection,
    value: string | number
  ) => {
    const updatedItems: MenuItemSelection[] = [...data.menu_items];
    updatedItems[index] = {
      ...updatedItems[index],
      [field]: field === 'qty' ? Number(value) : Number(value) || '',
    };
    setData('menu_items', updatedItems);
  };

  const removeMenuItem = (index: number) => {
    const filteredItems = data.menu_items.filter((_, i) => i !== index);
    setData('menu_items', filteredItems);
  };

  const submit = (e: React.FormEvent) => {
    e.preventDefault();
    post(route('client.orders.store'), {
      onSuccess: () => reset(),
    });

  };

  return (
    <>
      <Head title="Place Order" />
      
      <div className="min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white py-10 px-4">
        <div className="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-8">
          <h1 className="text-3xl font-bold mb-6 text-center">Place Your Order</h1>
          
          <form onSubmit={submit} className="space-y-6">
            {/* Customer Info */}
            <div>
              <label className="block font-medium mb-1">Name</label>
              <input
                type="text"
                value={data.customer_name}
                onChange={(e) => setData('customer_name', e.target.value)}
                className="w-full rounded border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 p-2"
              />
              {errors.customer_name && <p className="text-red-500 text-sm mt-1">{errors.customer_name}</p>}
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label className="block font-medium mb-1">Email</label>
                <input
                  type="email"
                  value={data.customer_email}
                  onChange={(e) => setData('customer_email', e.target.value)}
                  className="w-full rounded border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 p-2"
                />
                {errors.customer_email && <p className="text-red-500 text-sm mt-1">{errors.customer_email}</p>}
              </div>
              <div>
                <label className="block font-medium mb-1">Contact</label>
                <input
                  type="text"
                  value={data.customer_contact}
                  onChange={(e) => setData('customer_contact', e.target.value)}
                  className="w-full rounded border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 p-2"
                />
                {errors.customer_contact && <p className="text-red-500 text-sm mt-1">{errors.customer_contact}</p>}
              </div>
            </div>

            {/* Event Info */}
            <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <label className="block font-medium mb-1">Event Type</label>
                <input
                  type="text"
                  value={data.event_type}
                  onChange={(e) => setData('event_type', e.target.value)}
                  className="w-full rounded border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 p-2"
                />
                {errors.event_type && <p className="text-red-500 text-sm mt-1">{errors.event_type}</p>}
              </div>
              <div>
                <label className="block font-medium mb-1">Date</label>
                <input
                  type="date"
                  value={data.event_date}
                  onChange={(e) => setData('event_date', e.target.value)}
                  className="w-full rounded border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 p-2"
                />
                {errors.event_date && <p className="text-red-500 text-sm mt-1">{errors.event_date}</p>}
              </div>
              <div>
                <label className="block font-medium mb-1">Location</label>
                <input
                  type="text"
                  value={data.event_location}
                  onChange={(e) => setData('event_location', e.target.value)}
                  className="w-full rounded border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 p-2"
                />
                {errors.event_location && <p className="text-red-500 text-sm mt-1">{errors.event_location}</p>}
              </div>
            </div>

            {/* Menu Items */}
            <div>
              <h2 className="text-xl font-semibold mb-3">Menu Items</h2>
              {data.menu_items.map((item, idx) => (
                <div key={idx} className="flex space-x-2 mb-2">
                  <select
                    value={item.id}
                    onChange={(e) => updateMenuItem(idx, 'id', parseInt(e.target.value))}
                    className="flex-1 rounded border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 p-2"
                  >
                    <option value="">Select...</option>
                    {menuItems.map((mi) => (
                      <option key={mi.MenuItem_ID} value={mi.MenuItem_ID}>
                        {mi.Name} (${mi.Price})
                      </option>
                    ))}
                  </select>
                  <input
                    type="number"
                    min="1"
                    value={item.qty}
                    onChange={(e) => updateMenuItem(idx, 'qty', e.target.value)}
                    className="w-24 rounded border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-700 p-2"
                  />
                  <button
                    type="button"
                    onClick={() => removeMenuItem(idx)}
                    className="text-red-500 font-bold px-2"
                  >
                    ×
                  </button>
                </div>
              ))}
              <button
                type="button"
                onClick={addMenuItem}
                className="text-sm text-blue-600 hover:underline mt-2"
              >
                + Add Item
              </button>
              {errors.menu_items && <p className="text-red-500 text-sm mt-1">{errors.menu_items}</p>}
            </div>

                
            {/* Submit */}
            <div className="pt-4 gap-4 text-center">
              
              <button
                type="submit"
                disabled={processing}
                className="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded shadow disabled:opacity-50"
              >
                {processing ? 'Submitting…' : 'Submit Order'}
              </button>
              
              
            </div>
          </form>
        </div>
      </div>
    </>
  );
}
