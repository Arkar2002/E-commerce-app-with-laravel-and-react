function Input({ ...props }) {
  return (
    <input
      {...props}
      className="block w-full rounded border border-gray-300 px-4 py-2 text-sm text-gray-600 outline-none ring-primary focus:ring-1"
    />
  );
}

export default Input;
