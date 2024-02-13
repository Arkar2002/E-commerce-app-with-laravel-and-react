import { useSearchParams } from "react-router-dom";

function Select({ options, storageValue }) {
  const [searchParams, setSearchParams] = useSearchParams();
  const initialValue = searchParams.get("sortby") || options.at(0).value;

  function handleChange(e) {
    searchParams.set("sortby", e.target.value);
    setSearchParams(searchParams);
  }

  return (
    <select
      className="w-56 rounded border-gray-300 px-4 py-3 text-sm text-gray-800 shadow-sm outline-none focus:ring focus:ring-primary"
      value={initialValue}
      onChange={handleChange}
    >
      {options.map((option) => (
        <option key={option.label} value={option.value}>
          {option.label}
        </option>
      ))}
    </select>
  );
}

export default Select;
