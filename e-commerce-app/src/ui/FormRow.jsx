function FormRow({ label, children }) {
  return (
    <div className="mb-4">
      {label && (
        <label htmlFor={children.props.id} className="mb-2 block text-gray-600">
          {label}
        </label>
      )}
      {children}
    </div>
  );
}

export default FormRow;
