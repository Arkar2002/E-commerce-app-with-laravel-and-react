import { HiMagnifyingGlass } from "react-icons/hi2";

function Search() {
  return (
    <div className="relative flex sm:w-48 md:w-full md:max-w-xl">
      <HiMagnifyingGlass className="absolute left-2 top-2.5 text-xl" />
      <input
        type="text"
        className="w-full rounded-l border border-r-0 border-primary py-2 pl-12 pr-3 focus:outline-none focus:ring-1 focus:ring-primary"
        placeholder="Search"
      />
      <button className="rounded-r border border-primary bg-rose-500 px-2 text-slate-200 hover:bg-transparent hover:text-primary focus:ring-2">
        Search
      </button>
    </div>
  );
}

export default Search;
