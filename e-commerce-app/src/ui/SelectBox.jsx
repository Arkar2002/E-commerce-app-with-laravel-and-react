import { useSearchParams } from "react-router-dom";

function SelectBox({ options, label }) {
  const [searchParams, setSearchParams] = useSearchParams();

  const currentValue = searchParams.get(label) || "";

  function handleChange(value) {
    if (currentValue.includes(value)) {
      searchParams.set(label, currentValue.replaceAll(`%${value}`, ""));
      setSearchParams(searchParams);
    } else {
      searchParams.set(label, `${currentValue}%${value}`);
      setSearchParams(searchParams);
    }
  }

  return (
    <>
      {options?.map((option) => (
        <div key={option} className="flex items-center justify-between">
          <div className="flex items-center gap-2">
            <input
              id={option}
              type="checkbox"
              className="cursor-pointer accent-primary"
              onChange={() => handleChange(option)}
              checked={currentValue.includes(option)}
            />
            <label htmlFor={option} className="text-md text-gray-500">
              {option}
            </label>
          </div>
          <div className="text-sm text-gray-400">(150)</div>
        </div>
      ))}
    </>
  );
}

export default SelectBox;
