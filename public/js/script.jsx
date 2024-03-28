import React, { useState } from 'react';

const Pagination = ({ totalPages }) => {
  const [currentPage, setCurrentPage] = useState(0);

  const handlePageChange = (index) => {
    if (index < 0 || index >= totalPages) return;
    setCurrentPage(index);
  };

  return (
    <div className="flex items-center justify-center mt-5">
      <button
        className="py-2 px-3 text-gray-500 bg-white rounded-md focus:outline-none"
        disabled={currentPage === 0}
        onClick={() => handlePageChange(currentPage - 1)}
      >
        <span className="sr-only">Previous</span>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          className="h-5 w-5"
          viewBox="0 0 20 20"
          fill="currentColor"
        >
          <path
            fillRule="evenodd"
            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
            clipRule="evenodd"
          />
        </svg>
      </button>

      <div className="flex space-x-1">
        {Array.from({ length: totalPages }, (_, i) => i).map((page) => (
          <button
            key={page}
            className={`py-2 px-3 text-gray-500 bg-white rounded-md focus:outline-none ${
              currentPage === page ? 'font-bold bg-gray-200' : ''
            }`}
            aria-current={currentPage === page ? 'page' : undefined}
            onClick={() => handlePageChange(page)}
          >
            {page + 1}
          </button>
        ))}
      </div>

      <button
        className="py-2 px-3 text-gray-500 bg-white rounded-md focus:outline-none"
        disabled={currentPage === totalPages - 1}
        onClick={() => handlePageChange(currentPage + 1)}
      >
        <span className="sr-only">Next</span>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          className="h-5 w-5"
          viewBox="0 0 20 20"
          fill="currentColor"
        >
          <path
            fillRule="evenodd"
            d="M7.293 14.707a1 1 0 010-1.414L10.586 10l-3.293-3.293a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
            clipRule="evenodd"
          />
        </svg>
      </button>
    </div>
  );
};