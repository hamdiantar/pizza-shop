<?php

namespace App\Services;

use App\Helper\ReturnData;
use App\Models\Customer;
use App\Repositories\CustomerRepository;

class CustomerService
{
    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * @var ReturnData
     */
    protected $returnData;

    public function __construct(
        CustomerRepository $customerRepository,
        ReturnData $returnData
    ) {
        $this->customerRepository = $customerRepository;
        $this->returnData = $returnData;
    }

    public function CreateCustomer(array $customerData): ?Customer
    {
        return $this->customerRepository->create($customerData);
    }
}
